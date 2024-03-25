# web_ban-hoa-qua-BTS
=======
# MyApp
<ul>
Trang webite có 2 phần font-end và back-end riêng biệt cùng được xây dựng trên khung framework Laravel.
<li>Trang website đã được deploy phiên bản 1.0 trên hosting của inet (luôn được cập nhật và sửa đổi).</li>
<li>Trang người dùng: https://binhdt.id.vn </li>
<li>Trang quản trị: https://dashboard.binhdt.id.vn</li>
</ul>
## Mô tả dự án:

Lấy ý tưởng từ trang sendoFarm là trang bán nông sản sạch do tập đoàn FPT phát triển.

## Back End:

/Gồm quản lý tất cả các nội dung của trang website bao gồm: category, slider, blog, product, đơn hàng, thống kê đơn giản và phân quyền quản trị.
/-Sử dụng được các phần bao gồm database : migration, seeder, factory.
-Sử dụng các phần gồm controller : CRUD và nhiều hơn với làm việc bài bản với Elequent ORM và Query Builder, Relationship.
-Sử dụng các phần model, route bài bản hơn.
-Đã làm việc và sử dụng queue và job trong gửi mail và trong cập nhật trạng thái của đơn hàng khi kết nối với Giao Hàng Nhanh.
-Các tác vụ khác như events, listeners, task scheduing.
-Quản lý hình ảnh với filemanager trong toàn bộ trang website.
-Dùng laravel PassPost để quản lý quyền truy cập phía client.
-Một số nhỏ khác là : cache, session, collections.

## Font End
Sử dụng và trình bày các dữ liệu nhân được từ phía backend gửi đến. 
Xử lý một số phần như cart, checkout, login, register.
