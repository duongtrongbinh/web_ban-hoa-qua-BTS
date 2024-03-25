# web_ban-hoa-qua-BTS
=======
# MyApp

Trang webite có 2 phần font-end và back-end riêng biệt cùng được xây dựng trên khung framework Laravel.
<li>Trang website đã được deploy phiên bản 1.0 trên hosting của inet (luôn được cập nhật và sửa đổi).</li>
<li>Trang người dùng: https://binhdt.id.vn </li>
<li>Trang quản trị: https://dashboard.binhdt.id.vn</li>

## Các tài khoản
<table>
  <thead>
    <tr>
    <th>#</th>
    <th>Email</th>
    <th>Password</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Admin</td>
      <td>binhdtph25966@fpt.edu.vn</td>
      <td>12345678</td>
    </tr>
      <tr>
      <td>quản trị viên</td>
      <td>binhdtph25966@fpt.edu.vvvv</td>
      <td>12345678</td>
    </tr>
      <tr>
      <td>Blogger</td>
      <td>binhdtph25@gmail.com</td>
      <td>12345678</td>
    </tr>
  </tbody>
</table>
## Mô tả dự án:

Lấy ý tưởng từ trang sendoFarm là trang bán nông sản sạch do tập đoàn FPT phát triển.

## Back End:

Gồm quản lý tất cả các nội dung của trang website bao gồm: category, slider, blog, product, đơn hàng, thống kê đơn giản và phân quyền quản trị.
<li>Sử dụng được các phần bao gồm database : migration, seeder, factory.</li>
<li>Sử dụng các phần gồm controller : CRUD và nhiều hơn với làm việc bài bản với Elequent ORM và Query Builder, Relationship.</li>
<li>>Sử dụng các phần model, route bài bản hơn.</li>
<li>Đã làm việc và sử dụng queue và job trong gửi mail và trong cập nhật trạng thái của đơn hàng khi kết nối với Giao Hàng Nhanh.</li>
<li>Các tác vụ khác như events, listeners, task scheduing.</li>
<li>Quản lý hình ảnh với filemanager trong toàn bộ trang website.</li>
<li>Dùng laravel PassPost để quản lý quyền truy cập phía client.</li>
<li>Một số nhỏ khác là : cache, session, collections.</li>

## Font End
<li>Sử dụng và trình bày các dữ liệu nhân được từ phía backend gửi đến. </li>
<li>Xử lý một số phần như cart, checkout, login, register.</li>
