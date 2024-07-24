@extends('admin.admin_layout')
@section('content')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h4>Người Dùng</h4>
            </div>
            <div class="input-group" style="width: 300px; padding-left: 23px">
              <table>
                <tr>
                <th></th>
                <th></th>
                </tr>
                <tr>
                  <td>
                  <form method="post" style="width: 300px" action="/admin/user/search_user" enctype='multipart/form-data'>
                    <input type="text" class="form-control" name="username" placeholder="Tên người dùng...">
                    @csrf
                  </form>
                  </td>
                </tr>
              </table>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                  <div class="alert alert-success" style="color: white">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('fail'))
                  <div class="alert alert-danger" style="color: white">{{Session::get('fail')}}</div>
                @endif
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tên Người Dùng</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Số Điện Thoại</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Vai Trò </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phân Quyền </th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                    <tr>
                      <td style="width: 100px">
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $user->user_id }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                          <h6 class="mb-0 text-sm">{{ $user->fullname }}</h6>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <h6 class="mb-0 text-sm">{{ $user->email }}</h6>
                      </td>
                      <td class="align-middle text-center">
                        <h6 class="mb-0 text-sm">{{ $user->phone_number }}</h6>
                      </td>
                      <td class="align-middle text-center">
                        <h6 class="mb-0 text-sm">{{ $user->role }}</h6>
                      </td>
                      <td class="align-middle text-center">
                        <div class="dropdown">
                          <button onclick="toggleDropdown(this)" class="dropbtn text-center mt-3 btn btn-info">Phân Quyền</button>
                          <div class="dropdown-content">
                            @if ($user->role == 'Nhân Viên')
                            <form method="POST" action="/admin/user/update_role" enctype='multipart/form-data'> 
                              @csrf
                              <input hidden name="user_id" type="number" value="{{ $user->user_id }}">
                              <input hidden name="role" type="text" value="Khách Hàng">
                              <button type="submit">Khách Hàng</button>
                            </form>
                            @endif
                            @if ($user->role == 'Khách Hàng')
                            <form method="POST" action="/admin/user/update_role" enctype='multipart/form-data'>
                              @csrf
                              <input hidden name="user_id" type="number" value="{{ $user->user_id }}">
                              <input hidden name="role" type="text" value="Nhân Viên">
                              <button type="submit">Nhân Viên</button>
                            </form>
                            @endif
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      function toggleDropdown(button) {
        button.nextElementSibling.classList.toggle('show');
      }
    </script>
@endsection
