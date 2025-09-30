const { Pool } = require('pg');
const { Client, LocalAuth , MessageMedia } = require("whatsapp-web.js");
const qrcode = require("qrcode-terminal");
const fs = require('fs');
const PDFDocument = require('pdfkit');
const path = require('path');
const puppeteer = require('puppeteer');

const pool = new Pool({
    host: '85.31.224.243',
    port: 5432, 
    database: 'giras-adventure',
    user: 'postgres',
    password: 'SuksesJooal2024!',
});

// const pool = new Pool({
//     host: 'localhost',
//     port: 5432, 
//     database: 'a2',
//     user: 'postgres',
//     password: 'root',
// });


// const client = new Client({
//     authStrategy: new LocalAuth(),
// });

const client = new Client({
    authStrategy: new LocalAuth(),
    puppeteer: {
        headless: true, // Jalankan tanpa GUI
        args: ['--no-sandbox', '--disable-setuid-sandbox'], // Tambahkan argumen ini
    },
});


client.on('qr', (qr) => {
    console.log('QR RECEIVED, Scan it to use the service');
    qrcode.generate(qr, { small: true });
});

let isProcessing = false; // Flag untuk mencegah eksekusi bersamaan

client.on('ready', async () => {
    console.log('Client is ready to consume data!');

    setInterval(async () => {
        if (isProcessing) return;
        isProcessing = true;

        const queue = await consumeQueueWhatsapp();

        for (const whatsapp of queue) {
            const rawNumber = whatsapp.phone_number;
            const phoneNumber = normalizeNumber(rawNumber); // Pastikan format 62xxxx
            const chatId = phoneNumber + "@c.us";

            try {
                const isRegistered = await client.isRegisteredUser(chatId);
                if (!isRegistered) {
                    console.log(`❌ Nomor ${rawNumber} tidak terdaftar di WhatsApp`);
                    continue;
                }

                const order = whatsapp.order || {};
                const formatDate = (dateString) => {
                    const date = new Date(dateString);
                    return date.toLocaleDateString('id-ID', { weekday: 'long', day: '2-digit', month: 'long', year: 'numeric' }) +
                           " - " + date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                };
                const formatNumber = (num) => num ? `${num.toLocaleString('id-ID')}` : "";

                const daftarBarang = (order.order_products || []).map(product =>
                    `🔹 ${product.name} - Rp. ${formatNumber(product.selling_price)} x ${product.qty} = Rp. ${formatNumber(product.selling_price * product.qty)}`
                ).join("\n");

                let discountText = "";
                let subtotalAfterDiscount = order.subtotal;

                if (order.type_discount === "percent") {
                    let discountAmount = (order.subtotal * (order.percent_discount || 0)) / 100;
                    subtotalAfterDiscount -= discountAmount;
                    discountText = `${order.percent_discount || 0}% (Rp.${formatNumber(discountAmount)})`;
                } else {
                    subtotalAfterDiscount -= order.price_discount || 0;
                    discountText = `Rp.${formatNumber(order.price_discount || 0)}`;
                }

                const dendaMalam = parseInt(order.denda_malam) || 0;
                const dendaRusak = parseInt(order.denda_barang_rusak) || 0;
                const totalDenda = dendaMalam + dendaRusak;
                const subTotalText = `${order.sewa || 1} Malam x ${formatNumber(order.subtotal)} = ${formatNumber((order.sewa || 1) * order.subtotal)}`;

                let message = "";

                if (order.status_product === 'Product') {
                    message = `*PERSEWAAN DAN JUAL BELI ALAT CAMPING - GIRAS ADVENTURE*\n` +
                        `====================\n` +
                        `🔢 *No Nota*   : ${order.no_invoice || "-"}\n` +
                        `👤 *Pembeli*  : ${order.customer_name || "-"}\n` +
                        `📍 *Alamat*   : ${order.address || "-"}\n` +
                        `🗓 *Tgl Beli*  : ${formatDate(order.created_at)}\n` +
                        `👩‍💼 *Kasir*   : ${order.cashier_name || "-"}\n` +
                        `====================\n` +
                        `🏕 *Daftar Barang* :\n${daftarBarang || "Tidak ada barang"}\n` +
                        `💵 *Jumlah* : Rp. ${formatNumber(order.subtotal)}\n` +
                        `💵 *Diskon* : ${discountText}\n` +
                        `💵 *Total*  : Rp. ${formatNumber(order.total)}\n` +
                        `📍 *Alamat Toko 1*  : ${(order.address_shop)}\n` +
                        `📍 *Alamat Toko 2*  : ${(order.second_address_shop)}\n` +
                        `📌 Terima kasih sudah menyewa perlengkapan camping di tempat kami!\n`;
                } else if (order.status_product === 'Sewa Paid') {
                    message = `*SEWA ALAT CAMPING - GIRAS ADVENTURE*\n` +
                        `====================\n` +
                        `🔢 *No Nota*   : ${order.no_invoice || "-"}\n` +
                        `👤 *Penyewa*  : ${order.customer_name || "-"}\n` +
                        `📍 *Alamat*   : ${order.address || "-"}\n` +
                        `🗓 *Tgl Ambil*   : ${formatDate(order.start_date)}\n` +
                        `🗓 *Tgl Kembali* : ${formatDate(order.end_date)}\n` +
                        `🪪 *Jaminan*   : ${order.guarantee || "-"}\n` +
                        `👩‍💼 *Kasir*   : ${order.cashier_name || "-"}\n` +
                        `====================\n` +
                        `🏕 *Daftar Barang Sewa* :\n${daftarBarang || "Tidak ada barang"}\n` +
                        `💵 *Jumlah* : Rp. ${formatNumber(order.subtotal)}\n` +
                        `💵 *Diskon* : ${discountText}\n` +
                        `💵 *Sub Total*  : ${subTotalText}\n` +
                        `💵 *Denda Malam* : Rp. ${formatNumber(order.denda_malam)}\n` +
                        `💵 *Denda Rusak* : Rp. ${formatNumber(order.denda_barang_rusak)}\n` +
                        `💵 *Total*       : Rp. ${formatNumber(order.total)}\n` +
                        `*Kekurangan Denda* : Rp. ${formatNumber(totalDenda)}\n` +
                        `🟢 *Status* : SUDAH DIKEMBALIKAN\n` +
                        `====================\n` +
                        `📄 *SYARAT DAN KETENTUAN SEWA*:\n` +
                        `⿡ Saat pengambilan, penyewa wajib meninggalkan kartu identitas asli.\n` +
                        `⿢ Harga Penyewaan dihitung 2 hari 1 malam.\n` +
                        `⿣ Penyewa *WAJIB* menjaga peralatan yang disewa.\n` +
                        `⿤ Apabila ada barang yang disewa rusak/hilang, penyewa dikenakan biaya penggantian.\n` +
                        `⿥ Keterlambatan mengembalikan barang berarti memperpanjang sewa.\n` +
                        `⿥ Barang yang telah disewa sebaiknya diperiksa dahulu sebelum meninggalkan toko, karena setelah meninggalkan toko barang yang telah disewa menjadi tanggung jawab penyewa.\n` +
                        `⿥ Segala bentuk penipuan akan dilaporkan kepada pihak yang berwenang.\n` +

                        `📍 *Alamat Toko*  : ${(order.address_shop)}\n` +
                        `📍 *Alamat Toko Kedua*  : ${(order.second_address_shop)}\n` +
                        `====================\n`;
                } else {
                    message = `*SEWA ALAT CAMPING - GIRAS ADVENTURE*\n` +
                        `====================\n` +
                        `🔢 *No Nota*   : ${order.no_invoice || "-"}\n` +
                        `👤 *Penyewa*  : ${order.customer_name || "-"}\n` +
                        `📍 *Alamat*   : ${order.address || "-"}\n` +
                        `🗓 *Tgl Ambil*   : ${formatDate(order.start_date)}\n` +
                        `🗓 *Tgl Kembali* : ${formatDate(order.end_date)}\n` +
                        `🪪 *Jaminan*   : ${order.guarantee || "-"}\n` +
                        `👩‍💼 *Kasir*   : ${order.cashier_name || "-"}\n` +
                        `====================\n` +
                        `🏕 *Daftar Barang Sewa* :\n${daftarBarang || "Tidak ada barang"}\n` +
                        `💵 *Jumlah* : Rp. ${formatNumber(order.subtotal)}\n` +
                        `💵 *Diskon* : ${discountText}\n` +
                        `💵 *Sub Total*  : ${subTotalText}\n` +
                        `💵 *Total*  : Rp. ${formatNumber(order.total)}\n` +
                        `====================\n` +
                        `🟢 *Status* : Sudah Diambil\n` +
                        `====================\n` +
                        `📄 *SYARAT DAN KETENTUAN SEWA*:\n` +
                        `⿡ Saat pengambilan, penyewa wajib meninggalkan kartu identitas asli.\n` +
                        `⿢ Harga Penyewaan dihitung 2 hari 1 malam.\n` +
                        `⿣ Penyewa *WAJIB* menjaga peralatan yang disewa.\n` +
                        `⿤ Apabila ada barang yang disewa rusak/hilang, penyewa dikenakan biaya penggantian.\n` +
                        `⿥ Keterlambatan mengembalikan barang berarti memperpanjang sewa.\n` +
                        `⿥ Barang yang telah disewa sebaiknya diperiksa dahulu sebelum meninggalkan toko, karena setelah meninggalkan toko barang yang telah disewa menjadi tanggung jawab penyewa.\n` +
                        `⿥ Segala bentuk penipuan akan dilaporkan kepada pihak yang berwenang.\n` +

                        `📍 *Alamat Toko*  : ${(order.address_shop)}\n` +
                        `📍 *Alamat Toko Kedua*  : ${(order.second_address_shop)}\n` +
                        `====================\n`;
                }

                    try {
                        const sent = await client.sendMessage(chatId, message);

                        console.log(`✅ Pesan terkirim ke ${phoneNumber}`);

                        // Tetap hapus data meskipun error serialize muncul (catch di luar)
                        await deleteQueueWhatsapp(whatsapp.id);

                        await new Promise(resolve => setTimeout(resolve, 1000)); // delay agar tidak flood
                    } catch (error) {
                        // Cek apakah error hanya terkait serialize, bukan pengiriman
                        console.error(`❌ Gagal kirim ke ${phoneNumber}: ${error.message}`);

                        // Tetap hapus queue jika error mengandung "serialize"
                        if (error.message.includes('serialize')) {
                            console.warn(`⚠️ Kirim berhasil tapi error serialize, hapus queue manual...`);
                            await deleteQueueWhatsapp(whatsapp.id);
                        }
                    }

                await new Promise(resolve => setTimeout(resolve, 1000)); // delay antar kirim
            } catch (error) {
                console.error(`❌ Gagal kirim ke ${phoneNumber}: ${error.message}`);
            }
        }

        isProcessing = false;
    }, 2000);
});

function normalizeNumber(number) {
    if (number.startsWith('0')) {
        return '62' + number.slice(1);
    }
    return number;
}

// Fungsi untuk mengambil antrian dari database
async function consumeQueueWhatsapp() {
    const resultQuery = await pool.query('SELECT * FROM queue_whatsapps ORDER BY id ASC');
    const data = resultQuery.rows;

    for (const item of data) {
        // Ambil data order
        const orderQuery = await pool.query('SELECT * FROM orders WHERE id = $1', [item.order_id]);
        const orderData = orderQuery.rows[0];

        if (orderData) {
            // Ambil data order_products yang terkait dengan order ini
            const orderProductsQuery = await pool.query('SELECT * FROM order_products WHERE order_id = $1', [orderData.id]);
            orderData.order_products = orderProductsQuery.rows; // Tambahkan ke dalam order
        }

        item.order = orderData;
    }

    return data;
}


// Fungsi untuk menghapus antrian dari database
async function deleteQueueWhatsapp(id) {
    await pool.query('DELETE FROM queue_whatsapps WHERE id = $1', [id]);
}


consumeQueueWhatsapp();

client.initialize();
