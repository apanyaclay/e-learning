<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>


                {{-- Untuk role Admin --}}
                @if (Auth::user()->role == 'admin')
                    <li class="{{ set_active(['admin/dashboard']) }}">
                        <a href="{{ route('admin/dashboard') }}" class="{{ set_active(['admin/dashboard']) }}"><i
                                class="fas fa-tachometer-alt"></i>
                            <span> Dashboard</span></a>
                    </li>
                    <li
                        class="submenu {{ set_active(['admin/siswa', 'admin/siswa/add']) }} {{ request()->is('admin/siswa/edit/*') ? 'active' : '' }} {{ request()->is('admin/siswa/profile/*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-graduation-cap"></i>
                            <span> Siswa</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a href="{{ route('admin/siswa') }}" class="{{ set_active(['admin/siswa']) }}">Siswa
                                    List</a></li>
                            <li><a href="{{ route('admin/siswa/add') }}"
                                    class="{{ set_active(['admin/siswa/add']) }}">Siswa Add</a></li>
                            <li><a class="{{ request()->is('admin/siswa/edit/*') ? 'active' : '' }}">Siswa Edit</a>
                            </li>
                            <li><a href=""
                                    class="{{ request()->is('admin/siswa/profile/*') ? 'active' : '' }}">Siswa
                                    View</a></li>
                        </ul>
                    </li>

                    <li
                        class="submenu  {{ set_active(['admin/guru/add', 'admin/guru']) }} {{ request()->is('admin/guru/edit/*') ? 'active' : '' }} {{ request()->is('admin/guru/profile/*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-chalkboard-teacher"></i>
                            <span> Guru</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a href="{{ route('admin/guru') }}" class="{{ set_active(['admin/guru']) }}">Guru
                                    List</a></li>
                            <li><a href="{{ route('admin/guru/add') }}"
                                    class="{{ set_active(['admin/guru/add']) }}">Guru Add</a></li>
                            <li><a class="{{ request()->is('admin/guru/edit/*') ? 'active' : '' }}">Guru Edit</a>
                            </li>
                            <li><a href=""
                                    class="{{ request()->is('admin/guru/profile/*') ? 'active' : '' }}">Guru View</a>
                            </li>
                        </ul>
                    </li>

                    <li
                        class="submenu {{ set_active(['admin/jurusan/add', 'admin/jurusan']) }} {{ request()->is('admin/jurusan/edit/*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-building"></i>
                            <span> Jurusan</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a href="{{ route('admin/jurusan') }}"
                                    class="{{ set_active(['admin/jurusan']) }}">Jurusan List</a></li>
                            <li><a href="{{ route('admin/jurusan/add') }}"
                                    class="{{ set_active(['admin/jurusan/add']) }}">Jurusan Add</a></li>
                            <li><a class="{{ request()->is('admin/jurusan/edit/*') ? 'active' : '' }}">Jurusan
                                    Edit</a></li>
                        </ul>
                    </li>

                    <li
                        class="submenu {{ set_active(['admin/kelas', 'admin/kelas/add']) }} {{ request()->is('admin/kelas/edit/*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-book-reader"></i>
                            <span> Kelas</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a class="{{ set_active(['admin/kelas']) }}"href="{{ route('admin/kelas') }}">Kelas
                                    List</a></li>
                            <li><a class="{{ set_active(['admin/kelas/add']) }}"href="{{ route('admin/kelas/add') }}">Kelas
                                    Add</a></li>
                            <li><a class="{{ request()->is('admin/kelas/edit/*') ? 'active' : '' }}">Kelas Edit</a>
                            </li>
                        </ul>
                    </li>

                    <li
                        class="submenu {{ set_active(['admin/ta', 'admin/ta/add']) }} {{ request()->is('admin/ta/edit/*') ? 'active' : '' }}">
                        <a href="#"><i class="fa fa-calendar"></i>
                            <span> Tahun Ajaran</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a class="{{ set_active(['admin/ta']) }}"href="{{ route('admin/ta') }}">Tahun Ajaran
                                    List</a></li>
                            <li><a class="{{ set_active(['admin/ta/add']) }}"href="{{ route('admin/ta/add') }}">Tahun
                                    Ajaran
                                    Add</a></li>
                            <li><a class="{{ request()->is('admin/ta/edit/*') ? 'active' : '' }}">Tahun Ajaran Edit</a>
                            </li>
                        </ul>
                    </li>

                    <li
                        class="submenu {{ set_active(['admin/mapel', 'admin/mapel/add']) }} {{ request()->is('admin/mapel/edit/*') ? 'active' : '' }}">
                        <a href="#"><i class="fa fa-book"></i>
                            <span> Mapel</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a class="{{ set_active(['admin/mapel']) }}"href="{{ route('admin/mapel') }}">Mapel
                                    List</a></li>
                            <li><a class="{{ set_active(['admin/mapel/add']) }}"href="{{ route('admin/mapel/add') }}">Mapel
                                    Add</a></li>
                            <li><a class="{{ request()->is('admin/mapel/edit/*') ? 'active' : '' }}">Mapel Edit</a>
                            </li>
                        </ul>
                    </li>

                    <li
                        class="submenu {{ set_active(['admin/jadwal', 'admin/jadwal/add']) }} {{ request()->is('admin/jadwal/edit/*') ? 'active' : '' }}">
                        <a href="#"><i class="fa fa-table"></i>
                            <span> Jadwal</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a class="{{ set_active(['admin/jadwal']) }}"href="{{ route('admin/jadwal') }}">Jadwal
                                    List</a></li>
                            <li><a
                                    class="{{ set_active(['admin/jadwal/add']) }}"href="{{ route('admin/jadwal/add') }}">Jadwal
                                    Add</a></li>
                            <li><a class="{{ request()->is('admin/jadwal/edit/*') ? 'active' : '' }}">Jadwal Edit</a>
                            </li>
                        </ul>
                    </li>

                    <li
                        class="submenu {{ set_active(['admin/absensi', 'admin/absensi/add']) }} {{ request()->is('admin/absensi/edit/*') ? 'active' : '' }}">
                        <a href="#"><i class="fa fa-calendar"></i>
                            <span> Absensi</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a class="{{ set_active(['admin/absensi']) }}"href="{{ route('admin/absensi') }}">Absensi
                                    List</a></li>
                            <li><a
                                    class="{{ set_active(['admin/absensi/add']) }}"href="{{ route('admin/absensi/add') }}">Absensi
                                    Add</a></li>
                            <li><a class="{{ request()->is('admin/absensi/edit/*') ? 'active' : '' }}">Absensi Edit</a>
                            </li>
                        </ul>
                    </li>

                    <li
                        class="submenu {{ set_active(['admin/kuis', 'admin/kuis/add']) }} {{ request()->is('admin/kuis/edit/*') ? 'active' : '' }} {{ request()->is('admin/kuis/view/*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-clipboard-list"></i>
                            <span> Kuis</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a class="{{ set_active(['admin/kuis']) }}"href="{{ route('admin/kuis') }}">Kuis
                                    List</a></li>
                            <li><a class="{{ set_active(['admin/kuis/add']) }}"href="{{ route('admin/kuis/add') }}">Kuis
                                    Add</a></li>
                            <li><a class="{{ request()->is('admin/kuis/edit/*') ? 'active' : '' }}">Kuis Edit</a></li>
                            <li><a href="" class="{{ request()->is('admin/kuis/view/*') ? 'active' : '' }}">Kuis
                                    View</a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="submenu {{ set_active(['admin/tugas', 'admin/tugas/add']) }} {{ request()->is('admin/tugas/edit/*') ? 'active' : '' }} {{ request()->is('admin/tugas/view/*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-clipboard-list"></i>
                            <span> Tugas</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a class="{{ set_active(['admin/tugas']) }}"href="{{ route('admin/tugas') }}">Tugas
                                    List</a></li>
                            <li><a class="{{ set_active(['admin/tugas/add']) }}"href="{{ route('admin/tugas/add') }}">Tugas
                                    Add</a></li>
                            <li><a class="{{ request()->is('admin/tugas/edit/*') ? 'active' : '' }}">Tugas Edit</a>
                            </li>
                            <li><a href=""
                                    class="{{ request()->is('admin/tugas/view/*') ? 'active' : '' }}">Tugas
                                    View</a>
                            </li>
                        </ul>
                    </li>

                    <li
                        class="submenu {{ set_active(['admin/materi', 'admin/materi/add']) }} {{ request()->is('admin/materi/edit/*') ? 'active' : '' }} ">
                        <a href="#"><i class="fas fa-book-reader"></i>
                            <span> Materi</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a class="{{ set_active(['admin/materi']) }}"href="{{ route('admin/materi') }}">Materi
                                    List</a></li>
                            <li><a
                                    class="{{ set_active(['admin/materi/add']) }}"href="{{ route('admin/materi/add') }}">Materi
                                    Add</a></li>
                            <li><a class="{{ request()->is('admin/materi/edit/*') ? 'active' : '' }}">Materi Edit</a>
                            </li>
                        </ul>
                    </li>

                    <li
                        class="submenu {{ set_active(['admin/ebook', 'admin/ebook/add']) }} {{ request()->is('admin/ebook/edit/*') ? 'active' : '' }} ">
                        <a href="#"><i class="fa fa-bookmark"></i>
                            <span> E-Book</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a class="{{ set_active(['admin/ebook']) }}"href="{{ route('admin/ebook') }}">E-Book
                                    List</a></li>
                            <li><a
                                    class="{{ set_active(['admin/ebook/add']) }}"href="{{ route('admin/ebook/add') }}">E-Book
                                    Add</a></li>
                            <li><a class="{{ request()->is('admin/ebook/edit/*') ? 'active' : '' }}">E-Book Edit</a>
                            </li>
                        </ul>
                    </li>

                    <li
                        class="submenu {{ set_active(['admin/pertemuan', 'admin/pertemuan/add']) }} {{ request()->is('admin/pertemuan/edit/*') ? 'active' : '' }}">
                        <a href="#"><i class="fa fa-tasks"></i>
                            <span> Pertemuan</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a
                                    class="{{ set_active(['admin/pertemuan']) }}"href="{{ route('admin/pertemuan') }}">Pertemuan
                                    List</a></li>
                            <li><a
                                    class="{{ set_active(['admin/pertemuan/add']) }}"href="{{ route('admin/pertemuan/add') }}">Pertemuan
                                    Add</a></li>
                            <li><a class="{{ request()->is('admin/pertemuan/edit/*') ? 'active' : '' }}">Pertemuan
                                    Edit</a></li>
                        </ul>
                    </li>
                    <li class="{{ set_active(['setting']) }}">
                        <a href="{{ route('setting') }}">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                        </a>
                    </li>

                    {{-- Untuk role Guru --}}
                @elseif (Auth::user()->role == 'guru')
                    <li class="{{ set_active(['guru/dashboard']) }}">
                        <a href="{{ route('guru/dashboard') }}" class="{{ set_active(['guru/dashboard']) }}"><i
                                class="fas fa-tachometer-alt"></i>
                            <span> Dashboard</span></a>
                    </li>
                    <li class="{{ set_active(['guru/jadwal']) }}">
                        <a href="{{ route('guru/jadwal') }}" class="{{ set_active(['guru/jadwal']) }}"><i
                                class="fa fa-table"></i>
                            <span> Jadwal</span></a>
                    </li>
                    <li class="{{ set_active(['guru/kelas']) }}">
                        <a href="{{ route('guru/kelas') }}" class="{{ set_active(['guru/kelas']) }}"><i
                                class="fas fa-book-reader"></i>
                            <span> Kelas</span></a>
                    </li>
                    <li
                        class="submenu {{ set_active(['guru/pertemuan', 'guru/pertemuan/add']) }} {{ request()->is('guru/pertemuan/edit/*') ? 'active' : '' }}">
                        <a href="#"><i class="fa fa-tasks"></i>
                            <span> Pertemuan</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a
                                    class="{{ set_active(['guru/pertemuan']) }}"href="{{ route('guru/pertemuan') }}">Pertemuan
                                    List</a></li>
                            <li><a
                                    class="{{ set_active(['guru/pertemuan/add']) }}"href="{{ route('guru/pertemuan/add') }}">Pertemuan
                                    Add</a></li>
                            <li><a class="{{ request()->is('guru/pertemuan/edit/*') ? 'active' : '' }}">Pertemuan
                                    Edit</a></li>
                        </ul>
                    </li>
                    <li
                        class="submenu {{ set_active(['guru/materi', 'guru/materi/add']) }} {{ request()->is('guru/materi/edit/*') ? 'active' : '' }} ">
                        <a href="#"><i class="fas fa-book-reader"></i>
                            <span> Materi</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a class="{{ set_active(['guru/materi']) }}"href="{{ route('guru/materi') }}">Materi
                                    List</a></li>
                            <li><a
                                    class="{{ set_active(['guru/materi/add']) }}"href="{{ route('guru/materi/add') }}">Materi
                                    Add</a></li>
                            <li><a class="{{ request()->is('guru/materi/edit/*') ? 'active' : '' }}">Materi Edit</a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="submenu {{ set_active(['guru/ebook', 'guru/ebook/add']) }} {{ request()->is('guru/ebook/edit/*') ? 'active' : '' }} ">
                        <a href="#"><i class="fa fa-bookmark"></i>
                            <span> E-Book</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a class="{{ set_active(['guru/ebook']) }}"href="{{ route('guru/ebook') }}">E-Book
                                    List</a></li>
                            <li><a
                                    class="{{ set_active(['guru/ebook/add']) }}"href="{{ route('guru/ebook/add') }}">E-Book
                                    Add</a></li>
                            <li><a class="{{ request()->is('guru/ebook/edit/*') ? 'active' : '' }}">E-Book Edit</a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="submenu {{ set_active(['guru/kuis', 'guru/kuis/add']) }} {{ request()->is('guru/kuis/edit/*') ? 'active' : '' }} {{ request()->is('guru/kuis/view/*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-clipboard-list"></i>
                            <span> Kuis</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a class="{{ set_active(['guru/kuis']) }}"href="{{ route('guru/kuis') }}">Kuis
                                    List</a></li>
                            <li><a class="{{ set_active(['guru/kuis/add']) }}"href="{{ route('guru/kuis/add') }}">Kuis
                                    Add</a></li>
                            <li><a class="{{ request()->is('guru/kuis/edit/*') ? 'active' : '' }}">Kuis Edit</a></li>
                            <li><a href=""
                                    class="{{ request()->is('guru/kuis/view/*') ? 'active' : '' }}">Kuis
                                    View</a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="submenu {{ set_active(['guru/tugas', 'guru/tugas/add']) }} {{ request()->is('guru/tugas/edit/*') ? 'active' : '' }} {{ request()->is('guru/tugas/view/*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-clipboard-list"></i>
                            <span> Tugas</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a class="{{ set_active(['guru/tugas']) }}"href="{{ route('guru/tugas') }}">Tugas
                                    List</a></li>
                            <li><a
                                    class="{{ set_active(['guru/tugas/add']) }}"href="{{ route('guru/tugas/add') }}">Tugas
                                    Add</a></li>
                            <li><a class="{{ request()->is('guru/tugas/edit/*') ? 'active' : '' }}">Tugas Edit</a>
                            </li>
                            <li><a href=""
                                    class="{{ request()->is('guru/tugas/view/*') ? 'active' : '' }}">Tugas
                                    View</a>
                            </li>
                        </ul>
                    </li>
                    {{-- Untuk role Siswa --}}
                @elseif (Auth::user()->role == 'siswa')
                    <li class="{{ set_active(['siswa/dashboard']) }}">
                        <a href="{{ route('siswa/dashboard') }}" class="{{ set_active(['siswa/dashboard']) }}"><i
                                class="fas fa-tachometer-alt"></i>
                            <span> Dashboard</span></a>
                    </li>
                    <li
                        class="submenu  {{ set_active(['siswa/guru']) }} {{ request()->is('siswa/guru/profile/*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-chalkboard-teacher"></i>
                            <span> Guru</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a href="{{ route('siswa/guru') }}" class="{{ set_active(['siswa/guru']) }}">Guru
                                    List</a></li>
                            <li><a href=""
                                    class="{{ request()->is('siswa/guru/profile/*') ? 'active' : '' }}">Guru View</a>
                            </li>
                        </ul>
                    </li>

                    <li class="{{ set_active(['siswa/jurusan']) }}">
                        <a href="{{ route('siswa/jurusan') }}" class="{{ set_active(['siswa/jurusan']) }}"><i
                                class="fas fa-building"></i>
                            <span> Jurusan</span>
                        </a>
                    </li>

                    <li
                        class="submenu {{ set_active(['siswa/kelas']) }} {{ request()->is('siswa/siswa/profile/*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-book-reader"></i>
                            <span> Kelas</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a class="{{ set_active(['siswa/kelas']) }}"href="{{ route('siswa/kelas') }}">Siswa
                                    List</a></li>
                            <li><a href=""
                                    class="{{ request()->is('siswa/siswa/profile/*') ? 'active' : '' }}">Siswa
                                    View</a>
                            </li>
                        </ul>
                    </li>

                    <li class="{{ set_active(['siswa/mapel']) }} ">
                        <a href="{{ route('siswa/mapel') }}" class="{{ set_active(['siswa/mapel']) }}"><i
                                class="fa fa-book"></i>
                            <span> Mapel</span>
                        </a>
                    </li>

                    <li class="{{ set_active(['siswa/jadwal']) }} ">
                        <a href="{{ route('siswa/jadwal') }}" class="{{ set_active(['siswa/jadwal']) }}"><i
                                class="fa fa-table"></i>
                            <span> Jadwal</span>
                        </a>
                    </li>

                    <li
                        class="submenu {{ set_active(['siswa/pertemuan']) }} {{ request()->is('siswa/pertemuan/view/*') ? 'active' : '' }}">
                        <a href="#"><i class="fa fa-tasks"></i>
                            <span> Pertemuan</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a
                                    class="{{ set_active(['siswa/pertemuan']) }}"href="{{ route('siswa/pertemuan') }}">Pertemuan
                                    List</a></li>
                            <li><a href=""
                                    class="{{ request()->is('siswa/pertemuan/view/*') ? 'active' : '' }}">Pertemuan
                                    View</a></li>
                        </ul>
                    </li>
                    <li class="{{ set_active('siswa/absensi') }}">
                        <a href="{{ route('siswa/absensi') }}" class="{{ set_active('siswa/absensi') }}"><i
                                class="fa fa-calendar"></i>
                            <span> Absensi</span>
                        </a>
                    </li>
                    <li
                        class="submenu {{ set_active(['siswa/kuis']) }} {{ request()->is('siswa/kuis/kerjakan/*') ? 'active' : '' }} {{ request()->is('siswa/kuis/hasil/*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-clipboard-list"></i>
                            <span> Kuis</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a class="{{ set_active(['siswa/kuis']) }}"href="{{ route('siswa/kuis') }}">Kuis
                                    List</a></li>
                            <li><a href=""
                                    class="{{ request()->is('siswa/kuis/kerjakan/*') ? 'active' : '' }} {{ request()->is('siswa/kuis/hasil/*') ? 'active' : '' }}">Kuis
                                    View</a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="submenu {{ set_active(['siswa/tugas', 'siswa/tugas/add']) }} {{ request()->is('siswa/tugas/edit/*') ? 'active' : '' }} {{ request()->is('siswa/tugas/view/*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-clipboard-list"></i>
                            <span> Tugas</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a class="{{ set_active(['siswa/tugas']) }}"href="{{ route('siswa/tugas') }}">Tugas
                                    List</a></li>
                            <li><a href=""
                                    class="{{ request()->is('siswa/tugas/kerjakan/*') ? 'active' : '' }}">Tugas
                                    View</a>
                            </li>
                        </ul>
                    </li>
                @endif


                {{-- <li class="submenu {{ set_active([
                    'invoice/list/page',
                    'invoice/paid/page',
                    'invoice/overdue/page',
                    'invoice/draft/page',
                    'invoice/recurring/page',
                    'invoice/cancelled/page',
                    'invoice/grid/page',
                    'invoice/add/page',
                    'invoice/view/page',
                    'invoice/settings/page',
                    'invoice/settings/tax/page',
                    'invoice/settings/bank/page',
                ]) }}"
                    {{ request()->is('invoice/edit/*') ? 'active' : '' }}>
                    <a href="#"><i class="fas fa-clipboard"></i>
                        <span> Invoices</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a class="{{ set_active(['invoice/list/page', 'invoice/paid/page', 'invoice/overdue/page', 'invoice/draft/page', 'invoice/recurring/page', 'invoice/cancelled/page']) }}"
                                href="{{ route('invoice/list/page') }}">Invoices List</a></li>
                        <li><a class="{{ set_active(['invoice/grid/page']) }}"
                                href="{{ route('invoice/grid/page') }}">Invoices Grid</a></li>
                        <li><a class="{{ set_active(['invoice/add/page']) }}"
                                href="{{ route('invoice/add/page') }}">Add Invoices</a></li>
                        <li><a class="{{ request()->is('invoice/edit/*') ? 'active' : '' }}" href="">Edit
                                Invoices</a></li>
                        <li> <a class="{{ request()->is('invoice/view/*') ? 'active' : '' }}" href="">Invoices
                                Details</a></li>
                        <li><a class="{{ set_active(['invoice/settings/page', 'invoice/settings/tax/page', 'invoice/settings/bank/page']) }}"
                                href="{{ route('invoice/settings/page') }}">Invoices Settings</a></li>
                    </ul>
                </li>

                <li class="menu-title">
                    <span>Management</span>
                </li>

                <li class="submenu {{ set_active(['account/fees/collections/page', 'add/fees/collection/page']) }}">
                    <a href="#"><i class="fas fa-file-invoice-dollar"></i>
                        <span> Accounts</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a class="{{ set_active(['account/fees/collections/page']) }}"
                                href="{{ route('account/fees/collections/page') }}">Fees Collection</a></li>
                        <li><a href="expenses.html">Expenses</a></li>
                        <li><a href="salary.html">Salary</a></li>
                        <li><a class="{{ set_active(['add/fees/collection/page']) }}"
                                href="{{ route('add/fees/collection/page') }}">Add Fees</a></li>
                        <li><a href="add-expenses.html">Add Expenses</a></li>
                        <li><a href="add-salary.html">Add Salary</a></li>
                    </ul>
                </li>
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
                </li> --}}
            </ul>
        </div>
    </div>
</div>
