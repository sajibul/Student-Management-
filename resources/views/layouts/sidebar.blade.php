<!-- @php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
@endphp -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item has-treeview">
      <a href="{{route('home')}}" class="nav-link {{Request::is('home') ? 'active' : ''}}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard
          <!-- <i class="right fas fa-angle-left"></i> -->
        </p>
      </a>
    </li>
    @if(Auth::user()->role_id==1)
    <li class="nav-item has-treeview {{Request::is('allusers*') ? 'menu-open' : ''}}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
          Manage User
          <i class="fas fa-angle-left right"></i>
          <span class="badge badge-info right"></span>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{route('user-information.index')}}" class="nav-link {{Request::is('allusers/user-information*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>All Users</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('user-profile.index')}}" class="nav-link  {{Request::is('allusers/user-profile*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>User Profile</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item has-treeview {{Request::is('setup*') ? 'menu-open' : ''}}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
          Setup Management
          <i class="fas fa-angle-left right"></i>
          <span class="badge badge-info right"></span>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{route('class-information.index')}}" class="nav-link  {{Request::is('setup/class-information*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Student Class</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('year-information.index')}}" class="nav-link {{Request::is('setup/year-information*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Student Year</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('group-information.index')}}" class="nav-link {{Request::is('setup/group-information*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Student Group</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('shift-information.index')}}" class="nav-link {{Request::is('setup/shift-information*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Student Shift</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('free-category.index')}}" class="nav-link {{Request::is('setup/free-category*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Fee Category</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('free-amount.index')}}" class="nav-link {{Request::is('setup/free-amount*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Fee Category Amount</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('exam-type.index')}}" class="nav-link {{Request::is('setup/exam-type*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Exam Type</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('subject-view.index')}}" class="nav-link {{Request::is('setup/subject-view*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Subject View</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('assign-subject.index')}}" class="nav-link {{Request::is('setup/assign-subject*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Assign Subject</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('designation-information.index')}}" class="nav-link {{Request::is('setup/designation-information*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Designation</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item has-treeview {{Request::is('students*') ? 'menu-open' : ''}}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
          Manage Student
          <i class="fas fa-angle-left right"></i>
          <span class="badge badge-info right"></span>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{route('registration-student.index')}}" class="nav-link {{Request::is('students/registration-student*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Student Registration</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('student-roll-generate.index')}}" class="nav-link {{Request::is('students/student-roll-generate*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Roll Generate</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('registration-fee.index')}}" class="nav-link {{Request::is('students/registration-fee*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Registration Fee</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('monthly-fee.index')}}" class="nav-link {{Request::is('students/monthly-fee*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Monthly Fee</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('exam-fee.index')}}" class="nav-link {{Request::is('students/exam-fee*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Exam Fee</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item has-treeview {{Request::is('employee*') ? 'menu-open' : ''}}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
          Manage Employee
          <i class="fas fa-angle-left right"></i>
          <span class="badge badge-info right"></span>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{route('employee-registration.index')}}" class="nav-link {{Request::is('employee/employee-registration*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Employee Registration</p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{route('employee-salary.index')}}" class="nav-link {{Request::is('employee/employee-salary*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Employee Salary</p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{route('employee-leave.index')}}" class="nav-link {{Request::is('employee/employee-leave*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Employee Leave</p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{route('employee-attendance.index')}}" class="nav-link {{Request::is('employee/employee-attendance*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Employee Attendance</p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{route('employee-monthly-salary.index')}}" class="nav-link {{Request::is('employee/employee-monthly-salary*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Employee Monthly Salary</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item has-treeview {{Request::is('marks*') ? 'menu-open' : ''}}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
          Marks Management
          <i class="fas fa-angle-left right"></i>
          <span class="badge badge-info right"></span>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{route('student-marks-manage.index')}}" class="nav-link {{Request::is('marks/student-marks-manage*') ? 'active' : ''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Marks Entry</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('student-marks-edit')}}" class="nav-link {{Request::is('marks/student-marks-edit') ? 'active' : ' '}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Marks Edit</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('student-marks-edit')}}" class="nav-link {{Request::is('marks/student-marks-edit') ? 'active' : ' '}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Grade Point</p>
          </a>
        </li>
      </ul>
    </li>
    @else
    <li class="nav-item has-treeview {{Request::is('allusers*') ? 'menu-open' : ''}}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
          Manage User
          <i class="fas fa-angle-left right"></i>
          <span class="badge badge-info right"></span>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{route('user-profile.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>User Profile</p>
          </a>
        </li>
      </ul>
      
    </li>
    @endif
    <div class="dropdown-divider"></div>
    <label class="nav-item">Settion</label>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                           <i class="fa fa-power-off" aria-hidden="true"></i>
              {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </li>
</nav>
