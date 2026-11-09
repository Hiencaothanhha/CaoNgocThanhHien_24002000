const TheSanPham = {
    // Component nhận các prop: tên, giá, ảnh, mô tả, số lượng tồn
    props: {
        // Khai báo các prop với kiểu dữ liệu và yêu cầu bắt buộc
        ten: { type: String, required: true },
        gia: { type: Number, required: true },
        anh: { type: String, default: 'https://bizweb.dktcdn.net/thumb/1024x1024/100/329/122/products/ban-phim-co-khong-day-keychron-k2-he-resin-edition-rgb-hotswap-aluminum-magnetic-sw-04.jpg?v=1776765589057' },
        moTa: { type: String, default: 'Sản phẩm này hiện chưa có bài viết mô tả chi tiết.' },
        soLuongTon: { type: Number, required: true }
    },
    // Mỗi thẻ có nút "Xem mô tả" để bật tắt phần mô tả
    data() {
        return {
            hienThiMoTa: false
        }
    },
    computed: {
        // Kiểm tra hết hàng
        isHetHang() {
            return this.soLuongTon <= 0;
        },
        formatGia() {
            return new Intl.NumberFormat('vi-VN').format(this.gia) + ' đ';
        }
    },
    // Giao diện (Template) của riêng Component
    template: `
        <div class="card" :class="{ 'out-of-stock': isHetHang }">
            <img :src="anh" :alt="ten" class="card-img">
            
            <div class="card-body">
                <h3 class="product-name">{{ ten }}</h3>
                <p class="product-price">{{ formatGia }}</p>
                
                <!-- Nhãn riêng khi hết hàng / còn hàng -->
                <div class="status">
                    <span v-if="isHetHang" class="badge badge-danger">Hết hàng</span>
                    <span v-else class="badge badge-success">Kho: {{ soLuongTon }}</span>
                </div>

                <!-- Nút bật tắt mô tả, hoạt động độc lập -->
                <button class="btn-toggle" @click="hienThiMoTa = !hienThiMoTa">
                    {{ hienThiMoTa ? 'Ẩn mô tả' : 'Xem mô tả' }}
                </button>
                
                <div v-show="hienThiMoTa" class="description">
                    {{ moTa }}
                </div>

                <!-- Khóa nút Mua khi hết hàng -->
                <button class="btn-buy" :disabled="isHetHang">
                    {{ isHetHang ? 'Tạm ngưng bán' : 'Mua ngay' }}
                </button>
            </div>
        </div>
    `
};