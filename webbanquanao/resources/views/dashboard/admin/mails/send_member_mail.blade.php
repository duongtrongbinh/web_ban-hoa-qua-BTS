<h3>Bạn đã trở thành nhân viên của công ty Life Learn</h3>
<h5>Đây là tài khoản công ty cấp cho bạn < Cần được bảo mật để tránh mất mát của cá nhân cũng như tránh gây ảnh hưởng đến công ty></h5>
<table>
    <thead>
        <tr>
            <th>Name:</th>
            <th>Email:</th>
            <th>Phone:</th>
            <th>Password:</th>
            <th>Chức vụ:</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $data['name']}}</td>
            <td>{{ $data['email']}}</td>
            <td>{{ $data['phone']}}</td>
            <td>{{ $data['password']}}</td>
            <td>
                @foreach ($data['role'] as $item)
                    <h5>{{ $item}}</h5>
                @endforeach
            </td>
        </tr>
    </tbody>
</table>