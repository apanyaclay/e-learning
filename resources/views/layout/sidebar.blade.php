<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>
                @if (Auth::user()->role == 'admin')
                <li class="{{set_active('admin/dashboard')}}">
                    <a href="{{route('admin/dashboard')}}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="submenu {{set_active(['admin/users'])}} {{ (request()->is('view/user/edit/*')) ? 'active' : '' }}">
                    <a href="#">
                        <i class="fas fa-shield-alt"></i>
                        <span>Manajemen Pengguna</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('admin/users/list') }}" class="{{set_active(['admin/users'])}} {{ (request()->is('view/user/edit/*')) ? 'active' : '' }}">List Pengguna</a></li>
                    </ul>
                </li>
                <li class="submenu {{set_active(['admin/siswa','admin/siswa/add'])}} {{ (request()->is('admin/siswa/edit/*')) ? 'active' : '' }} {{ (request()->is('admin/siswa/profile/*')) ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-graduation-cap"></i>
                        <span> Siswa</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('admin/siswa/list') }}"  class="{{set_active(['admin/siswa'])}}">List Siswa</a></li>
                        <li><a href="{{ route('admin/siswa/add') }}" class="{{set_active(['admin/siswa/add'])}}">Tambah Siswa</a></li>
                        <li><a class="{{ (request()->is('admin/siswa/edit/*')) ? 'active' : '' }}">Edit Siswa</a></li>
                        <li><a href=""  class="{{ (request()->is('admin/siswa/show/*')) ? 'active' : '' }}">Lihat Siswa</a></li>
                    </ul>
                </li>
                <li class="{{set_active(['admin/jadwal'])}}">
                    <a href="{{ route('admin/jadwal/list') }}">
                        <i class="fas fa-book-reader"></i>
                        <span>Mata Pelajaran</span>
                    </a>
                </li>
                <li class="{{set_active(['admin/profile'])}}">
                    <a href="{{ route('admin/profile') }}">
                        <i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>

                {{--
                <li class="submenu  {{set_active(['teacher/add/page','teacher/list/page','teacher/grid/page','teacher/edit'])}} {{ (request()->is('teacher/edit/*')) ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i>
                        <span> Teachers</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('teacher/list/page') }}" class="{{set_active(['teacher/list/page','teacher/grid/page'])}}">Teacher List</a></li>
                        <li><a href="teacher-details.html">Teacher View</a></li>
                        <li><a href="{{ route('teacher/add/page') }}" class="{{set_active(['teacher/add/page'])}}">Teacher Add</a></li>
                        <li><a class="{{ (request()->is('teacher/edit/*')) ? 'active' : '' }}">Teacher Edit</a></li>
                    </ul>
                </li> --}}

                {{-- <li class="submenu {{set_active(['department/add/page','department/edit/page'])}} {{ request()->is('department/edit/*') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-building"></i>
                        <span> Departments</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('department/list/page') }}" class="{{set_active(['department/list/page'])}} {{ request()->is('department/edit/*') ? 'active' : '' }}">Department List</a></li>
                        <li><a href="{{ route('department/add/page') }}" class="{{set_active(['department/add/page'])}}">Department Add</a></li>
                        <li><a>Department Edit</a></li>
                    </ul>
                </li> --}}

                {{-- <li class="submenu {{set_active(['subject/list/page','subject/add/page'])}} {{ request()->is('subject/edit/*') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-book-reader"></i>
                        <span> Subjects</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a class="{{set_active(['subject/list/page'])}} {{ request()->is('subject/edit/*') ? 'active' : '' }}" href="{{ route('subject/list/page') }}">Subject List</a></li>
                        <li><a class="{{set_active(['subject/add/page'])}}" href="{{ route('subject/add/page') }}">Subject Add</a></li>
                        <li><a>Subject Edit</a></li>
                    </ul>
                </li>--}}
                @elseif (Auth::user()->role == 'pengajar')
                <li class="{{set_active('pengajar/dashboard')}}">
                    <a href="{{route('pengajar/dashboard')}}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="submenu {{set_active(['pengajar/siswa','pengajar/siswa/add'])}} {{ (request()->is('pengajar/siswa/edit/*')) ? 'active' : '' }} {{ (request()->is('pengajar/siswa/profile/*')) ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-graduation-cap"></i>
                        <span> Siswa</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('pengajar/siswa/list') }}"  class="{{set_active(['pengajar/siswa'])}}">List Siswa</a></li>
                        <li><a href="{{ route('pengajar/siswa/add') }}" class="{{set_active(['pengajar/siswa/add'])}}">Tambah Siswa</a></li>
                        <li><a class="{{ (request()->is('pengajar/siswa/edit/*')) ? 'active' : '' }}">Edit Siswa</a></li>
                        <li><a href=""  class="{{ (request()->is('pengajar/siswa/show/*')) ? 'active' : '' }}">Lihat Siswa</a></li>
                    </ul>
                </li>
                <li class="{{set_active(['pengajar/jadwal'])}}">
                    <a href="{{ route('pengajar/jadwal/list') }}">
                        <i class="fas fa-book-reader"></i>
                        <span>Mata Pelajaran</span>
                    </a>
                </li>
                <li class="{{set_active(['pengajar/profile'])}}">
                    <a href="{{ route('pengajar/profile') }}">
                        <i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                @elseif (Auth::user()->role == 'siswa')
                <li class="{{set_active('siswa/dashboard')}}">
                    <a href="{{route('siswa/dashboard')}}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{set_active(['siswa/mapel'])}}">
                    <a href="{{ route('siswa/mapel/list') }}">
                        <i class="fas fa-book-reader"></i>
                        <span>Mata Pelajaran</span>
                    </a>
                </li>
                <li class="{{set_active(['siswa/profile'])}}">
                    <a href="{{ route('siswa/profile') }}">
                        <i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>

                @endif
                <li class="{{set_active(['setting/page'])}}">
                    <a href="{{ route('setting/page') }}">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <li class="menu-title">
                    <span>Management</span>
                </li>

                {{-- <li class="submenu {{set_active(['account/fees/collections/page','add/fees/collection/page'])}}">
                    <a href="#"><i class="fas fa-file-invoice-dollar"></i>
                        <span> Accounts</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a class="{{set_active(['account/fees/collections/page'])}}" href="{{ route('account/fees/collections/page') }}">Fees Collection</a></li>
                        <li><a href="expenses.html">Expenses</a></li>
                        <li><a href="salary.html">Salary</a></li>
                        <li><a class="{{set_active(['add/fees/collection/page'])}}" href="{{ route('add/fees/collection/page') }}">Add Fees</a></li>
                        <li><a href="add-expenses.html">Add Expenses</a></li>
                        <li><a href="add-salary.html">Add Salary</a></li>
                    </ul>
                </li> --}}
                <li>
                    <a href="holiday.html"><i class="fas fa-holly-berry"></i> <span>Holiday</span></a>
                </li>
                <li>
                    <a href="fees.html"><i class="fas fa-comment-dollar"></i> <span>Fees</span></a>
                </li>
                <li>
                    <a href="exam.html"><i class="fas fa-clipboard-list"></i> <span>Exam list</span></a>
                </li>
                <li>
                    <a href="event.html"><i class="fas fa-calendar-day"></i> <span>Events</span></a>
                </li>
                <li>
                    <a href="library.html"><i class="fas fa-book"></i> <span>Library</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
