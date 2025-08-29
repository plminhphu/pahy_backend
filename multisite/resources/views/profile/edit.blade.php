@extends('layouts.app')
@section('content')
<div class="container py-5">
  <div class="row">
    <div class="col-md-4">
      <div class="card mb-4">
        <img src="https://yevgenysim-turkey.github.io/dashbrd/assets/img/photos/photo-2.jpg" class="card-img-top" alt="Avatar">
        <div class="card-body text-center">
          <h5 class="card-title mb-0">Michael Johnson</h5>
          <div class="text-muted mb-2">Quantum Dynamics Bio</div>
          <p class="card-text">Hi! I'm Michael Johnson, a software engineer from San Francisco, California. I'm passionate about technology, design, and startups. I'm currently working at Quantum Dynamics as a front-end developer.</p>
          <div class="mb-2">
            <a href="mailto:michael.johnson@company.com" class="me-2"><i class="bi bi-envelope"></i> Email</a>
            <a href="tel:+1234567890"><i class="bi bi-telephone"></i> Phone</a>
          </div>
          <button class="btn btn-outline-primary btn-sm me-2">Edit</button>
          <button class="btn btn-outline-danger btn-sm">Delete</button>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card mb-4">
        <div class="card-header fw-bold">Billing</div>
        <div class="card-body">
          <p>Billing information is securely stored with our payment processor and is not accessible to us.</p>
          <div class="mb-2"><i class="bi bi-credit-card"></i> **** **** **** 1234 (exp. 12/24) <span class="badge bg-primary">Primary</span></div>
          <div><i class="bi bi-credit-card"></i> **** **** **** 5678 (exp. 08/27)</div>
        </div>
      </div>
      <div class="card mb-4">
        <div class="card-header fw-bold">Security</div>
        <div class="card-body">
          <p>Secure your account with a strong password and two-factor authentication.</p>
          <div class="mb-2"><i class="bi bi-phone"></i> iPhone 15 Seattle, Washington · 2 hours ago</div>
          <div class="mb-2"><i class="bi bi-laptop"></i> MacBook Pro San Francisco, California · 1 day ago</div>
          <button class="btn btn-outline-warning btn-sm">Sign out from all devices</button>
        </div>
      </div>
      <div class="card">
        <div class="card-header fw-bold">Additional Links</div>
        <div class="card-body">
          <a href="#">Dashbrd</a> |
          <a href="#">Account</a> |
          <a href="#">General</a> |
          <a href="#">Billing</a> |
          <a href="#">Security</a> |
          <a href="#">Delete account</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection