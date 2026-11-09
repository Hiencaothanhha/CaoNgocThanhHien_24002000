const DongGioHang = {
    // Nhận dữ liệu qua props, không gán lại hay sửa đổi trực tiếp prop
    props: {
        id: { type: Number, required: true },
        ten: { type: String, required: true },
        donGia: { type: Number, required: true },
        soLuong: { type: Number, required: true }
    },
    // Khai báo các sự kiện tùy chỉnh sẽ phát lên cha
    emits: ['doi-so-luong', 'yeu-cau-xoa'],
    
    computed: {
        // Hiển thị thành tiền
        thanhTien() {
            return this.donGia * this.soLuong;
        },
        formatDonGia() {
            return new Intl.NumberFormat('vi-VN').format(this.donGia) + ' đ';
        },
        formatThanhTien() {
            return new Intl.NumberFormat('vi-VN').format(this.thanhTien) + ' đ';
        }
    },
    
    methods: {
        // Gửi mã sản phẩm và số lượng mới
        thayDoiSoLuong(delta) {
            const soLuongMoi = this.soLuong + delta;
            this.$emit('doi-so-luong', this.id, soLuongMoi);
        },
        // Gửi mã sản phẩm cần xóa
        xoaSanPham() {
            this.$emit('yeu-cau-xoa', this.id);
        }
    },
    
    // Giao diện (Template) của 1 dòng trong bảng
    template: `
        <tr>
            <td><strong>{{ ten }}</strong></td>
            <td class="text-right">{{ formatDonGia }}</td>
            <td class="text-center">
                <!-- Nút giảm: vô hiệu hóa nếu số lượng <= 1 -->
                <button class="btn-qty" @click="thayDoiSoLuong(-1)" :disabled="soLuong <= 1">-</button>
                
                <span class="qty-display">{{ soLuong }}</span>
                
                <!-- Nút tăng: vô hiệu hóa nếu số lượng >= 99 -->
                <button class="btn-qty" @click="thayDoiSoLuong(1)" :disabled="soLuong >= 99">+</button>
            </td>
            <td class="text-right text-danger font-bold">{{ formatThanhTien }}</td>
            <td class="text-center">
                <button class="btn-delete" @click="xoaSanPham">Xóa</button>
            </td>
        </tr>
    `
};