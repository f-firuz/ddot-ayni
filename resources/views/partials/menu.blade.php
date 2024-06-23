<div class="sidebar  ">
    <nav class="sidebar-nav ">

        <ul class="nav">
            <li class="nav-item ">
                <a href="{{ route("admin.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('user_management_access')
            <li class="nav-item nav-dropdown">
                <a class="nav-link  nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="nav-dropdown-items">
                    @can('permission_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-unlock-alt nav-icon"></i>
                            {{-- Разрешения--}}
                            {{ trans('cruds.permission.title') }}
                        </a>
                    </li>
                    @endcan
                    @can('role_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                            {{-- Роли--}}
                            <i class="fa-fw fas fa-briefcase nav-icon">
                            </i>
                            {{ trans('cruds.role.title') }}
                        </a>
                    </li>
                    @endcan
                    @can('user_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-user nav-icon">

                            </i>
                            {{ trans('cruds.user.title') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.user.getAllStudents")}}" class="nav-link {{ request()->is('admin/users/studens') || request()->is('admin/users/studens*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-user nav-icon">

                            </i>
                            Студенты
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.user.getAllTeachrs") }}" class="nav-link {{ request()->is('admin/users/teachers') || request()->is('admin/users/teachers*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-user nav-icon">

                            </i>
                            Учителя
                        </a>
                    </li>

                    @endcan
                </ul>
            </li>
            @endcan

            @can('facultets_access')
            <!-- {{-- Facultet --}} -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route("admin.facultets.index") }}">
                    <i class="fa-fw fas fa-school nav-icon">

                    </i>
                    {{ trans('cruds.faculties.name') }}
                </a>

            </li>
            @endcan
            @can('school_class_access')
            <li class="nav-item">
                <a href="{{ route("admin.school-classes.index") }}" class="nav-link {{ request()->is('admin/school-classes') || request()->is('admin/school-classes/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-school nav-icon">

                    </i>
                    <!-- {{ trans('cruds.schoolClass.title') }} -->
                    {{ trans('cruds.specialtys.name') }}
                </a>
            </li>
            @endcan




            <li class="nav-item">
                <a href="{{ auth()->user() && (auth()->user()->is_student || auth()->user()->is_teacher) ? route('admin.calendar.index') : route('admin.indexAllfacultets.index') }}" class="nav-link {{ request()->is('admin/getAllfacultets') || request()->is('admin/getAllfacultets/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-calendar nav-icon"></i>
                    Расписание
                </a>
            </li>



            <li class="nav-item">
                <a href="{{ route("admin.attendance.index") }}" class="nav-link {{ request()->is('admin/attendance') || request()->is('admin/attendance/*') ? 'active' : '' }}">

                    <i class="fa-fw fas fa-book nav-icon">

                    </i>
                    Журнал группы
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route("admin.attnb-index") }}" class="nav-link {{ request()->is('admin/attnb') || request()->is('admin/attnb/*') ? 'active' : '' }}">

                    <i class="fa-fw fas fa-book nav-icon">

                    </i>
                    Журнал НБ
                </a>
            </li>

            
            @can('lesson_access')
            <li class="nav-item">
                <a href="{{ route("admin.lessons.index") }}" class="nav-link {{ request()->is('admin/lessons') || request()->is('admin/lessons/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-clock nav-icon">

                    </i>
                    {{ trans('cruds.lesson.title') }}
                </a>
            </li>
            @endcan
            @can('type_grades_access')
            <li class="nav-item">
                <a href="{{ route("admin.type-grades.index") }}" class="nav-link {{ request()->is('admin/type-grades') || request()->is('admin/type-grades/*') ? 'active' : '' }}">

                    <i class="fa-fw fas fa-book nav-icon">

                    </i>
                    Тип оценки
                </a>
            </li>
            @endcan
            @can('type_grades_access')
            <li class="nav-item">
                <a href="{{ route("admin.dostup-lesson-index") }}" class="nav-link {{ request()->is('admin/dostup-lesson') || request()->is('admin/dostup-lesson/*') ? 'active' : '' }}">

                    <i class="fa-fw fas fa-book nav-icon">

                    </i>
                    Доступа на урока
                </a>
            </li>
            @endcan
            <li class="nav-item">
                <a href="{{ route("admin.profile.index") }}" class="nav-link {{ request()->is('admin/profile') || request()->is('admin/profile/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-user nav-icon">

                    </i>
                    Профиль
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer " type="button" style="background-color: white;"></button>
</div>

<style>
  
</style>