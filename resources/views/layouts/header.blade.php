@php 
  $user = backpack_user();
@endphp

<nav class="navbar sticky-top navbar-expand-lg" style="background-color: #45526e">
  <a class="navbar-brand text-white p-0" style="padding-left:1% !important" href="{{ url('/') }}">
    <img src="{{ asset('images/train.png') }}" width="50" height="50" class="d-inline-block align-center " alt=""> YataYat
  </a>
  <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="la la-bars"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav text-center">
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ url('/') }}">Home </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ url('aboutus') }}">About Us </a>
      </li>
      @if($user)
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ url('logout') }}">Logout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('userprofile.edit',$user->id) }}"><i class="la la-user la-2x"></i></a>
        </li>
      @else
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ url('login') }}">Log In <span class="sr-only"></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ url('register') }}">Register <span class="sr-only"></span></a>
        </li>
      @endif
    </ul>
  </div>
</nav>

@if(isset($user))
  <div align="right" style="margin-right:20px; margin-top:2px">
    <a href="javascript:;" class="btn btn-md btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">SEARCH TICKET</a>
    <a class="btn btn-md btn-secondary" href="{{ route('vehiclehire.create') }}">VEHICLE HIRE</a>
  </div>
@endif

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="staticBackdropLabel">Search Ticket</h5>
                <i class="la la-times la-2x" id="close" data-bs-dismiss="modal" aria-label="Close" style="cursor:pointer;"></i>
            </div>
            <div class="modal-body">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Ticket Number:</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Eg:124xyba4677">
            </div>
            </div>
            <div class="modal-footer">
            <button type="button " class="btn btn-primary btn-block">Search</button>
            </div>
        </div>
    </div>
</div>