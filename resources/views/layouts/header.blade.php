<nav class="navbar sticky-top navbar-expand-lg" style="background-color: #45526e">
  <a class="navbar-brand text-white p-0" style="padding-left:1% !important" href="{{ url('/') }}">
    <img src="{{ asset('images/train.png') }}" width="50" height="50" class="d-inline-block align-center " alt=""> YataYat
  </a>
  <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="la la-bars"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link text-white" href="{{ url('/') }}">Home </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link text-white" href="javascript:;">About Us </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ url('login') }}">Log In <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ url('register') }}">Register <span class="sr-only"></span></a>
      </li>
    </ul>
  </div>
</nav>