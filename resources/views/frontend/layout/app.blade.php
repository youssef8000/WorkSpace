<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{config('app.name','Workspace')}}</title>
  <link rel="stylesheet" href="{{asset("assets/css/main.css")}}" />
  <link rel="stylesheet" href="{{asset("assets/css/normalize.css")}}" />
  <link rel="stylesheet" href="{{asset("assets/css/all.min.css")}}" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&#038;display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('assets/css/main.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />

</head>

<body>
  <!-- ======= Header ======= -->
  <nav>
    <div class="logo" style="width: 30%"><a href="/home"><img class="logo" style="width: 90%" src="{{asset('assets/img/LOGO_BLUE.png')}}" alt=""></a></div>
    <div class="nav-items">
    @if(Auth::check())
    @if(Auth::user()->type == 'client') <!-- Check if the type of auth is user -->
        <a href="{{route("show-freelancers")}}">Find Freelancers</a>
    @elseif(Auth::user()->type == 'freelancer')
        <a href="{{route("find.Job")}}">Find Jobs</a>

    @else
        <a href="{{route("show-freelancers")}}">Find Freelancers</a>
        <a href="{{route("find.Job")}}">Find Jobs</a>
    @endif
@else
    <a href="{{route("show-freelancers")}}">Find Freelancers</a>
    <a href="{{route("find.Job")}}">Find Jobs</a>
@endif


    <a href="/#about-us">Why Workspace</a>
    @if(Auth::check())
        <a href="{{ route('Profile') }}">My Profile</a>
        <a href="/chats">Message</a>
    @endif
      @guest
      <a href="/login">Login</a>
      @else
      <a href="{{ route('logout') }}">Logout</a>
      @endguest
    </div>
  </nav>
  <!-- End Header -->

  @yield("content")

  <footer>
    <div class="footer-container">
    <div class="footer-section links">
    <div class="container-fluid">
        <div class="row">
            <img class="logo" style="width: 50%" src="{{asset('assets/img/LOGO_WHITE_footer.png')}}" alt="">
        </div>
    </div>
    </div>
      @if(Auth::check())
      @if(Auth::user()->type == 'client')
      <div class="footer-section links">
        <h2>Client</h2>
        <ul>
          <li><a href="{{route("show-freelancers")}}">Explore Freelancers</a></li>
          <li><a href="{{route('post-job-form')}}">Post Job</a></li>
          <li><a href="#Contact">Contact</a></li>
        </ul>
      </div>
      @elseif(Auth::user()->type == 'freelancer')
      <div class="footer-section links">
        <h2>Freelancers</h2>
        <ul>
          <li><a href="{{route("find.Job")}}">Explore Jobs</a></li>
          <li><a href="{{ route('add-project') }}">Upload a Project</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </div>


      @endif

  @endif


      <div class="footer-section about">
        <h2>About us</h2>
        <p>
          WorkSpace,Whether you're a client seeking innovative solutions or a
          freelancer looking to work with us, you're in the right place
        </p>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2024 WorkSpace. All Rights Reserved.</p>
    </div>
  </footer>

  <script src="{{asset('assets/js/main.js')}}"></script>
  <script src="{{asset('assets/js/script.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>
