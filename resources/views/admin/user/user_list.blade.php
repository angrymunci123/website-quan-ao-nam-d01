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
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tên Người Dùng</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Số Điện Thoại</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Chức Vụ </th>

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
                        <div class="dropdown">
                          <button onclick="myFunction()" class="dropbtn text-center mt-3 btn btn-info">Quản Lý</button>
                          <div id="myDropdown" class="dropdown-content">
                            <a href="#">Khách Hàng</a>
                            <a href="#">Quản Lý</a>
                            <a href="#">Nhân Viên</a>
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
  </main>
  @endsection
