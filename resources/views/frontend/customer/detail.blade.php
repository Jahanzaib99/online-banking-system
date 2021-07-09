@extends('frontend.layout.layout')
@section('content')
    <!-- ======= Hero Section ======= -->
    <div class="dash-board">
        <div class="row">
            <div class="col-sm-4">
                <div class="d-flex align-items-start dash-left">
                    <h1 class="text-white">Dashboard</h1>
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-all-details-tab" data-bs-toggle="pill" data-bs-target="#v-pills-all-details" type="button" role="tab" aria-controls="v-pills-all-details" aria-selected="true">All details</button>
                        <button class="nav-link" id="v-pills-account-tab" data-bs-toggle="pill" data-bs-target="#v-pills-account" type="button" role="tab" aria-controls="v-pills-account" aria-selected="false">Account number</buttona>
                            <button class="nav-link" id="v-pills-name-tab" data-bs-toggle="pill" data-bs-target="#v-pills-name" type="button" role="tab" aria-controls="v-pills-name" aria-selected="false">Full Name</button>
                            <button class="nav-link" id="v-pills-email-tab" data-bs-toggle="pill" data-bs-target="#v-pills-email" type="button" role="tab" aria-controls="v-pills-email" aria-selected="false">Email</button>
                            <button class="nav-link" id="v-pills-phone-tab" data-bs-toggle="pill" data-bs-target="#v-pills-phone" type="button" role="tab" aria-controls="v-pills-phone" aria-selected="false">Phone Number</button>
                            <button class="nav-link" id="v-pills-req-tab" data-bs-toggle="pill" data-bs-target="#v-pills-req" type="button" role="tab" aria-controls="v-pills-req" aria-selected="false">Request</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 dash-right">
                <div class="tab-content" id="v-pills-tabContent">
                    <h1>All Details</h1>
                    <div class="tab-pane fade show active" id="v-pills-all-details" role="tabpanel" aria-labelledby="v-pills-all-details-tab">
                        <div class="details-item">
                            <h3>Account Number</h3>
                            <p>#00012345678</p>
                        </div>
                        <div class="details-item">
                            <h3>Full Name</h3>
                            <p>{{isset($user->name) ? $user->name : "" }}</p>
                        </div>
                        <div class="details-item">
                            <h3>Email Address</h3>
                            <p>{{isset($user->email) ? $user->email : "" }}</p>
                        </div>
                        <div class="details-item">
                            <h3>Phone Number</h3>
                            <p>{{isset($user->phone) ? $user->phone : "" }}</p>
                        </div>
                        <div class="details-item">
                            <h3>Requests</h3>
                            <p>#00012345678</p>
                        </div>
                        <div class="details-item">
                            <h3>Part Details</h3>
                            <p>#Mini Car Door - Thunder - Left Passenger Door</p>
                        </div>
                        <div class="details-item">
                            <h3>Delivery Details</h3>
                            <p>#Tracking number UPS 12345678909876</p>
                        </div>
                        <div class="details-item">
                            <h3>Lead Time</h3>
                            <p>#eg. 14 days</p>
                        </div></div>
                    <div class="tab-pane fade" id="v-pills-account" role="tabpanel" aria-labelledby="v-pills-account-tab">
                        <div class="details-item">
                            <h3>Account Number</h3>
                            <p>#00012345678</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-name" role="tabpanel" aria-labelledby="v-pills-name-tab">
                        <div class="details-item">
                            <h3>Full Name</h3>
                            <p>{{isset($user->name) ? $user->name : "" }}</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-email" role="tabpanel" aria-labelledby="v-pills-email-tab">

                        <div class="details-item">
                            <h3>Email Address</h3>
                            <p>{{isset($user->email) ? $user->email : "" }}</p>
                        </div></div>
                    <div class="tab-pane fade" id="v-pills-phone" role="tabpanel" aria-labelledby="v-pills-phone-tab">

                        <div class="details-item">
                            <h3>Phone Number</h3>
                            <p>{{isset($user->phone) ? $user->phone : "" }}</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-req" role="tabpanel" aria-labelledby="v-pills-req-tab">
                        <div class="details-item">
                            <h3>Requests</h3>
                            <p>#00012345678</p>
                        </div>
                        <div class="details-item">
                            <h3>Part Details</h3>
                            <p>#Mini Car Door - Thunder - Left Passenger Door</p>
                        </div>
                        <div class="details-item">
                            <h3>Delivery Details</h3>
                            <p>#Tracking number UPS 12345678909876</p>
                        </div>
                        <div class="details-item">
                            <h3>Lead Time</h3>
                            <p>#eg. 14 days</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-dashboard">
        <div class="mobile-dashboard-items">
            <h1>Dashboard</h1>
            <div class="details-item">
                <h3>Account Number</h3>
                <p>00012345678</p>
            </div>
            <div class="details-item">
                <h3>Full Name</h3>
                <p>John Davis</p>
            </div>
            <div class="details-item">
                <h3>Email Address</h3>
                <p>abcd@example.com</p>
            </div>
            <div class="details-item">
                <h3>Phone Number</h3>
                <p>00012345678</p>
            </div>
            <div class="details-item">
                <h3>Requests</h3>
                <p>00012345678</p>
            </div>
            <div class="details-item">
                <h3>Part Details</h3>
                <p>Mini Car Door - Thunder - Left Passenger Door</p>
            </div>
            <div class="details-item">
                <h3>Delivery Details</h3>
                <p>Tracking number UPS 12345678909876</p>
            </div>
            <div class="details-item">
                <h3>Lead Time</h3>
                <p>eg. 14 days</p>
            </div>
        </div>
    </div>
    <!-- ======= End Hero ======= -->
@endsection

