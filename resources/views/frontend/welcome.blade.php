@extends("frontend.layout.app")

@section("content")

<section class="hero">
    <div class="hero-container">
      <div class="column-left">
        <h1 style="color: white">Unlock Your Freelancing Potential with Workspace!</h1>
        <p>
          Connect, collaborate, and succeed on a platform designed for the modern professional.
        </p>


            @if(Auth::check())
                @else
                <form action="{{ route('registration') }}" method="GET" style="display: inline;">
                    <button>GET STARTED FOR FREE</button>
                </form>
            @endif


      </div>
      <div class="column-right">
        <img
          src="{{asset('assets/img/image-1.svg')}}"
          alt="illustration"
          class="hero-image"
        />
      </div>
    </div>
  </section>

  @if(Auth::check())
    @if(Auth::user()->type == 'freelancer')
  <div class="container-fluid" style="margin-top: 30px">
    <div class="row">
        <div class="col-lg-3">
        <div class="card" style="width: 18rem;">
            <img src="{{asset('assets/img/website.webp')}}" class="card-img-top" alt="">
            <div class="card-body">
              <h5 class="card-title">Web Development</h5>
              <a href="{{ route('jobs.by_category', ['slug' => 'web-development']) }}" >View all</a>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
            <div class="card" style="width: 18rem;">
                <img src="{{asset('assets/img/graphic-design.webp')}}" class="card-img-top" alt="">
                <div class="card-body">
                  <h5 class="card-title">Graphic Design</h5>
                  <a href="{{ route('jobs.by_category', ['slug' => 'graphic-design']) }}" >View all</a>
                </div>
              </div>
            </div>
            <div class="col-lg-3">
                <div class="card" style="width: 18rem;">
                    <img src="{{asset('assets/img/mobile.webp')}}" class="card-img-top" alt="">
                    <div class="card-body">
                      <h5 class="card-title">Mobile Development</h5>
                      <a href="{{ route('jobs.by_category', ['slug' => 'mobile-development']) }}" >View all</a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{asset('assets/img/internet-marketing.webp')}}" class="card-img-top" alt="">
                        <div class="card-body">
                          <h5 class="card-title">Digital Marketing</h5>
                          <a href="{{ route('jobs.by_category', ['slug' => 'digital-marketing']) }}" >View all</a>
                        </div>
                      </div>
                    </div>
    </div>
  </div>
@endif
@endif

@if(Auth::check())
    @if(Auth::user()->type == 'client') <!-- Check if the type of auth is user -->
    <div class="steps-container">
      <div class="image">
        <img src="{{asset('assets/img/about-img.jpg')}}" alt="How it works image" />
      </div>
      <div class="steps-content">
        <h1>How It Works</h1>
        <div class="step">
          <h2>Step 1</h2>
          <p>Explanation of step 1 goes here.</p>
        </div>
        <div class="step">
          <h2>Step 2</h2>
          <p>Explanation of step 2 goes here.</p>
        </div>
        <div class="step">
          <h2>Step 3</h2>
          <p>Explanation of step 3 goes here.</p>
        </div>
        <div class="step">
          <h2>Step 4</h2>
          <p>Explanation of step 4 goes here.</p>
        </div>
        <form action="{{route('post-job-form')}}" method="GET" style="display: inline;">
        <button type="submit" class="post-project-btn">Post a Job</button>
    </form>
      </div>
    </div>
    @elseif(Auth::user()->type == 'freelancer')
    <div class="steps-container">
      <div class="image">
        <img src="{{asset('assets/img/about-img.jpg')}}" alt="How it works image" />
      </div>
      <div class="steps-content">
        <h1>How It Works</h1>
        <div class="step">
          <h2>Step 1</h2>
          <p>Explanation of step 1 goes here.</p>
        </div>
        <div class="step">
          <h2>Step 2</h2>
          <p>Explanation of step 2 goes here.</p>
        </div>
        <div class="step">
          <h2>Step 3</h2>
          <p>Explanation of step 3 goes here.</p>
        </div>
        <div class="step">
          <h2>Step 4</h2>
          <p>Explanation of step 4 goes here.</p>
        </div>
        <form action="{{ route('add-project') }}" method="GET" style="display: inline;">
        <button type="submit" class="post-project-btn">Post a Project</button>
    </form>
      </div>
    </div>
    @endif
@else
<section class="services">

    <h2>Elevate Your Freelancing Game!</h2>

    <li>

      <h3>Join for free</h3>
      <p>Sign up for free to explore rising talents, browse projects and many more.</p>

    </li>

    <li>

      <h3>Post gigs and hire top talents</h3>
      <p>Hiring good freelancers doesn't have to be that difficult. Post a job and we can search for you.</p>

    </li>

    <li>

      <h3>Easily land your first gig</h3>
      <p>Workspace makes it easier for beginners to stand out and land their first job.</p>

    </li>

    <div class="servicesignup">
    <form action="{{ route('registration') }}" method="GET" style="display: inline;">
    <button>Sign up for free</button>
    </form>
  </div>
  </section>
@endif




  <Section class="about-us" id="about-us">
  <div class="about-us-client">
      <div class="about-us-client-container">
        <h1>About Us</h1>
        <div class="about-us-client-content">
          <div class="image">
            <img src="{{asset('assets/img/LOGO_BLUE.png')}}" class="card-img-top" alt="">
          </div>
          <div class="text">
            <p>
              Welcome to Workspace! We are a team of passionate freelancers
              dedicated to delivering high-quality services tailored to your
              needs. Whether you're a client seeking innovative solutions or a
              freelancer looking to work with us, you're in the right place. Our
              expertise includes web development, graphic design, content
              creation, and digital marketing.
            </p>
            <p>
              At Workspace, we value transparency, quality work . We strive to
              build lasting relationships and make every project a success.
              Thank you for considering Workspace. Together, we can achieve
              greatness!
            </p>
          </div>
        </div>
      </div>
    </div>


  </Section>
  @if(Auth::check())

@else
<section class="trending-skills">

<div class="container">
  <h1>TOP SKILLS</h1>
  <div class="grid">
      <div class="columnx">
          <p>Generative AI Specialists</p>
          <p>Data Entry Specialists</p>
          <p>Video Editors</p>
          <p>Data Analyst</p>
          <p>Shopify Developer</p>
          <p>Ruby on Rails Developer</p>
          <p>Android Developer</p>
          <p>Bookkeeper</p>
          <p>Content Writer</p>
          <p>Copywriter</p>
          <p>Data Scientist</p>
          <p>Front-End Developer</p>
          <p>Game Developer</p>
          <p>Graphic Designer</p>
          <p>iOS Developer</p>
      </div>
      <div class="columnx">
          <p>JavaScript Developer</p>
          <p>Logo Designer</p>
          <p>Mobile App Developer</p>
          <p>PHP Developer</p>
          <p>Python Developer</p>
          <p>Resume Writer</p>
          <p>SEO Expert</p>
          <p>Social Media Manager</p>
          <p>Software Developer</p>
          <p>Software Engineer</p>
          <p>Technical Writer</p>
          <p>UI Designer</p>
          <p>UX Designer</p>
          <p>Virtual Assistant</p>
          <p>Web Designer</p>
      </div>
  </div>
</div>


</section>
<section class="final">
    <div class="final-button">
    <form action="{{ route('registration') }}" method="GET" style="display: inline;">
        <button>GET STARTED FOR FREE</button>
    </form>
  </div>
  <P>Already have an account? <span class="log"><a href="{{ route('login') }}">Log in</a></span></P>
  </section>
@endif





@endsection
