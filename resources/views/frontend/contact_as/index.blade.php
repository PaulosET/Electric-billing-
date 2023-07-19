@extends('layouts.app')

@section('title', 'Contact')

@section('content')

<section id="page-title">
  <div class="container clearfix">
    <h1>Contact</h1>
    <span>Get in Touch with Us</span>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Contact</li>
    </ol>
  </div>
</section>

<section id="content">
  <div class="content-wrap">
    <div class="container">
      <div class="row gutter-40 col-mb-80">
        <div class="postcontent col-lg-9">
          <h3>Send us an Email</h3>
          <div class="form-widget">
            <div class="form-result"></div>
            <form class="mb-0" id="template-contactform" name="template-contactform" action="include/form.php" method="post">
              <div class="form-process">
                <div class="css3-spinner">
                  <div class="css3-spinner-scaler"></div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="template-contactform-name">Name <small>*</small></label>
                  <input type="text" id="template-contactform-name" name="template-contactform-name" value="" class="sm-form-control required" />
                </div>
                <div class="col-md-6 form-group">
                  <label for="template-contactform-email">Email <small>*</small></label>
                  <input type="email" id="template-contactform-email" name="template-contactform-email" value="" class="required email sm-form-control" />
                </div>
                <div class="col-md-6 form-group">
                  <label for="template-contactform-phone">Phone</label>
                  <input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="sm-form-control" />
                </div>
                <div class="col-md-6 form-group">
                  <label for="template-contactform-subject">Subject <small>*</small></label>
                  <input type="text" id="template-contactform-subject" name="subject" value="" class="required sm-form-control" />
                </div>
                <div class="col-12 form-group">
                  <label for="template-contactform-message">Message <small>*</small></label>
                  <textarea class="required sm-form-control" id="template-contactform-message" name="template-contactform-message" rows="6" cols="30"></textarea>
                </div>
                <div class="col-12 form-group d-none">
                  <input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" class="sm-form-control" />
                </div>
                <div class="col-12 form-group">
                  <button class="button button-3d m-0" type="submit" id="template-contactform-submit" name="template-contactform-submit" value="submit">Send Message</button>
                </div>
              </div>
              <input type="hidden" name="prefix" value="template-contactform-">
            </form>
          </div>
        </div>
        <div class="sidebar col-lg-3">
          <address>
            <strong>Headquarters:</strong><br>
            {{-- {{ $appSetting->address }} --}}<br>
          </address>
          <abbr title="Phone Number"><strong>Phone:</strong></abbr> {{-- {{ $appSetting->phone1 }} --}}<br>
          <abbr title="Phone Number"><strong>Phone:</strong></abbr>{{--  {{ $appSetting->phone2 }} --}}<br>
          {{-- <abbr title="Fax"><strong>Email:</strong></abbr> (1) 11 4752 1433<br> --}}
          <abbr title="Email Address"><strong>Email:</strong></abbr> {{-- {{ $appSetting->email1 }} --}}<br>
          <div class="widget border-0 pt-0">
            <div class="fslider customjs testimonial twitter-scroll twitter-feed" data-username="envato" data-count="3" data-animation="slide" data-arrows="false">
              <i class="i-plain i-small color icon-twitter mb-0" style="margin-right: 15px;"></i>
              <div class="flexslider" style="width: auto;">
                <div class="slider-wrap">
                  <div class="slide"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="widget border-0 pt-0">
            <a href="{{-- {{ $appSetting->facebook }} --}}" class="social-icon si-small si-dark si-facebook">
              <i class="icon-facebook"></i>
              <i class="icon-facebook"></i>
            </a>
            <a href="{{-- {{ $appSetting->twitter }} --}}" class="social-icon si-small si-dark si-twitter">
              <i class="icon-twitter"></i>
              <i class="icon-twitter"></i>
            </a>
            <a href="{{-- {{ $appSetting->linkedin }} --}}" class="social-icon si-small si-borderless si-linkedin">
              <i class="icon-linkedin"></i>
              <i class="icon-linkedin"></i>
            </a>
            <a href="{{-- {{ $appSetting->instagram }} --}}" class="social-icon si-small si-borderless si-instagram">
              <i class="icon-instagram"></i>
              <i class="icon-instagram"></i>
            </a>
            <a href="{{-- {{ $appSetting->youtube }} --}}" class="social-icon si-small si-borderless si-youtube">
              <i class="icon-youtube"></i>
              <i class="icon-youtube"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
