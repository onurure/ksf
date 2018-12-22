@extends('layouts.sone')

@section('content')

    <div class="row">
        <div class="page-header">
            <div class="d-flex align-items-center">
                <h2 class="page-header-title">Dashboard</h2>
                <div>
                <div class="page-header-tools">
                    <a class="btn btn-gradient-01" href="#">Add Widget</a>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Begin Row -->
    <div class="row flex-row">
        <div class="col-xl-6 col-md-6 os-animation" data-os-animation="fadeInUp">
            <div class="widget widget-21 has-shadow">
                <div class="widget-body h-100 d-flex align-items-center">
                    <div class="section-title">
                        <h3>Hit Rate</h3>
                    </div>
                    <div class="hit-rate">
                        <div class="percent"></div>
                    </div>
                    <div class="value-progress text-green">
                        + 34%
                    </div>
                </div>
            </div>
            <div class="widget widget-22 bg-gradient-03">
                <div class="widget-body h-100 d-flex align-items-center">
                    <div class="section-title">
                        <h3>Happy Customers</h3>
                    </div>
                    <div class="happy-customers">
                        <div class="percent"></div>
                    </div>
                    <div class="value-progress">
                        + 54 Today
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 os-animation" data-os-animation="fadeInUp">
            <!-- Begin Widget 04 -->
            <div class="widget widget-04 has-shadow">
                <!-- Begin Widget Header -->
                <div class="widget-header bordered d-flex align-items-center">
                    <h2>Post</h2>
                    <div class="widget-options">
                        <div class="dropdown">
                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                                <i class="la la-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item"> 
                                    <i class="la la-check"></i>Valid Post
                                </a>
                                <a href="#" class="dropdown-item"> 
                                    <i class="la la-edit"></i>Edit Widget
                                </a>
                                <a href="faq.html" class="dropdown-item faq"> 
                                    <i class="la la-question-circle"></i>FAQ
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Widget Header -->
                <!-- Begin Widget Body -->
                <div class="widget-body p-0">
                    <div class="post-container">
                        <div class="media mb-3">
                            <div class="media-left align-self-center user">
                                <a href="pages-profile.html"><img src="assets/img/avatar/avatar-07.jpg" class="rounded-circle" alt="..."></a>
                            </div>
                            <div class="media-body align-self-center ml-3">
                                <div class="title">
                                    <span class="username">Lisa Garett</span> posted an image
                                </div>
                                <div class="time">42 min ago</div>
                            </div>
                        </div>
                        <img src="assets/img/background/01.jpg" alt="..." class="img-fluid">
                        <div class="col no-padding d-flex justify-content-end mt-3">
                            <div class="meta">
                                <ul>
                                    <li><a href="#"><i class="la la-comment"></i><span class="numb">38</span></a></li>
                                    <li><a href="#"><i class="la la-heart"></i><span class="numb">94</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Begin Write Comment -->
                    <div class="input-group mt-5">
                        <input type="text" class="form-control pr-0" placeholder="Write a comment ...">
                        <span class="input-group-addon">
                            <button class="btn" type="button">
                                <i class="la la-smile-o la-2x"></i>
                            </button>
                        </span>
                        <span class="input-group-addon">
                            <button class="btn pr-3" type="button">
                                <i class="la la-pencil la-2x"></i>
                            </button>
                        </span>
                    </div>
                    <!-- End Write Comment -->
                </div>
                <!-- End Widget Body -->
            </div>
            <!-- End Widget 04 -->
        </div>
    </div>
    <!-- End Row -->
    <div class="row flex-row">
        <div class="col-xl-6 col-md-6 os-animation" data-os-animation="fadeInUp">
            <!-- Begin Widget 05 -->
            <div class="widget widget-05 has-shadow">
                <!-- Begin Widget Header -->
                <div class="widget-header bordered d-flex align-items-center">
                    <h2>Top Author</h2>
                    <div class="widget-options">
                        <div class="dropdown">
                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                                <i class="la la-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item"> 
                                    <i class="la la-edit"></i>Edit Widget
                                </a>
                                <a href="#" class="dropdown-item faq"> 
                                    <i class="la la-question-circle"></i>FAQ
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Widget Header -->
                <!-- Begin Widget Body -->
                <div class="widget-body no-padding hidden">
                    <div class="author-avatar">
                        <span class="badge-pulse-green"></span>
                        <img src="assets/img/avatar/avatar-03.jpg" alt="..." class="img-fluid rounded-circle">
                    </div>
                    <div class="author-name">
                        Louis Henry
                        <span>Designer</span>
                    </div>
                    <div class="chart">
                        <div class="row no-margin justify-content-center">
                            <div class="col-12 col-xl-8 col-md-8 col-sm-8">
                                <div class="row no-margin align-items-center">
                                    <!-- Begin Chart -->
                                    <div class="col-9 no-padding">
                                        <div class="chart-graph">
                                            <div class="chart">
                                                <canvas id="sales-stats"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 no-padding text-center">
                                        <div class="chart-text">
                                            <span class="heading">Sales</span>
                                            <span class="number">364</span>
                                            <span class="cxg text-green">+35%</span>
                                        </div>
                                    </div>
                                    <!-- End Chart -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="social-stats">
                        <div class="row d-flex justify-content-between">
                            <div class="col-4 text-center">
                                <i class="la la-users followers"></i>
                                <div class="counter">+124</div>
                                <div class="heading">Followers</div>
                            </div>
                            <div class="col-4 text-center">
                                <i class="la la-dribbble dribbble"></i>
                                <div class="counter">+357</div>
                                <div class="heading">Likes</div>
                            </div>
                            <div class="col-4 text-center">
                                <i class="la la-behance behance"></i>
                                <div class="counter">+98</div>
                                <div class="heading">Followers</div>
                            </div>
                        </div>
                    </div>
                    <div class="actions text-center">
                        <a href="pages-profile.html" class="btn btn-gradient-01">View Profile</a>
                    </div>
                </div>
                <!-- End Widget Body -->
            </div>
            <!-- End Widget 05 -->
        </div>
        <div class="col-xl-6 os-animation" data-os-animation="fadeInUp">
            <!-- Begin Widget 06 -->
            <div class="widget widget-06 has-shadow">
                <!-- Begin Widget Header -->
                <div class="widget-header bordered d-flex align-items-center">
                    <h2>Reviews</h2>
                    <div class="widget-options">
                        <div class="dropdown">
                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                                <i class="la la-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item"> 
                                    <i class="la la-edit"></i>Edit Widget
                                </a>
                                <a href="#" class="dropdown-item faq"> 
                                    <i class="la la-question-circle"></i>FAQ
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Widget Header -->
                <!-- Begin Widget Body -->
                <div class="widget-body p-0">
                    <div id="list-group" class="widget-scroll" style="max-height:490px;">
                        <ul class="reviews list-group w-100">
                            <!-- 01 -->
                            <li class="list-group-item">
                                <div class="media">
                                    <div class="media-left align-self-start">
                                        <img src="assets/img/avatar/avatar-02.jpg" class="user-img rounded-circle" alt="...">
                                    </div>
                                    <div class="media-body align-self-center">
                                        <div class="username">
                                            <h4>Brandon Smith</h4>
                                        </div>
                                        <div class="msg">
                                            <div class="stars">
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star-half-empty"></i>
                                            </div>
                                            <p>
                                                WoW! Amazing Work!
                                            </p>
                                        </div>
                                        <div class="meta">
                                            <span class="mr-3">30 minutes ago - 1 Reply</span>
                                            <a href="#">Reply</a>
                                        </div>
                                    </div>
                                    <div class="media-right pr-3 align-self-center">
                                        <div class="like text-center">
                                            <i class="ion-heart"></i>
                                            <span>12</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- End 01 -->
                            <!-- 02 -->
                            <li class="list-group-item">
                                <div class="media">
                                    <div class="media-left align-self-start">
                                        <img src="assets/img/avatar/avatar-05.jpg" class="user-img rounded-circle" alt="...">
                                    </div>
                                    <div class="media-body align-self-center">
                                        <div class="username">
                                            <h4>Megan Duncan</h4>
                                        </div>
                                        <div class="msg">
                                            <div class="stars">
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                            </div>
                                            <p>
                                                Very nice! Keep up the beautiful work.
                                            </p>
                                        </div>
                                        <div class="meta">
                                            <span class="mr-3">2 hours ago</span>
                                            <a href="#">Reply</a>
                                        </div>
                                    </div>
                                    <div class="media-right pr-3 align-self-center">
                                        <div class="like text-center">
                                            <i class="ion-heart"></i>
                                            <span>4</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- End 02 -->
                            <!-- 03 -->
                            <li class="list-group-item">
                                <div class="media">
                                    <div class="media-left align-self-start">
                                        <img src="assets/img/avatar/avatar-04.jpg" class="user-img rounded-circle" alt="...">
                                    </div>
                                    <div class="media-body align-self-center">
                                        <div class="username">
                                            <h4>Nathan Hunter</h4>
                                        </div>
                                        <div class="msg">
                                            <div class="stars">
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                            </div>
                                            <p>
                                                Nice work, good design!
                                            </p>
                                        </div>
                                        <div class="meta">
                                            <span class="mr-3">4 hours ago</span>
                                            <a href="#">Reply</a>
                                        </div>
                                    </div>
                                    <div class="media-right pr-3 align-self-center">
                                        <div class="like text-center">
                                            <i class="ion-heart"></i>
                                            <span>32</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- End 03 -->
                            <!-- 04 -->
                            <li class="list-group-item">
                                <div class="media">
                                    <div class="media-left align-self-start">
                                        <img src="assets/img/avatar/avatar-09.jpg" class="user-img rounded-circle" alt="...">
                                    </div>
                                    <div class="media-body align-self-center">
                                        <div class="username">
                                            <h4>Michael Bradley</h4>
                                        </div>
                                        <div class="msg">
                                            <div class="stars">
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star-half-empty"></i>
                                            </div>
                                            <p>
                                                Very nice! Keep up the beautiful work.
                                            </p>
                                        </div>
                                        <div class="meta">
                                            <span class="mr-3">5 hours ago - 2 Reply</span>
                                            <a href="#">Reply</a>
                                        </div>
                                    </div>
                                    <div class="media-right pr-3 align-self-center">
                                        <div class="like text-center">
                                            <i class="ion-heart"></i>
                                            <span>2</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- End 04 -->
                            <!-- 05 -->
                            <li class="list-group-item">
                                <div class="media">
                                    <div class="media-left align-self-start">
                                        <img src="assets/img/avatar/avatar-03.jpg" class="user-img rounded-circle" alt="...">
                                    </div>
                                    <div class="media-body align-self-center">
                                        <div class="username">
                                            <h4>Louis Henry</h4>
                                        </div>
                                        <div class="msg">
                                            <div class="stars">
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star-half-empty"></i>
                                            </div>
                                            <p>
                                                I like the color combination!
                                            </p>
                                        </div>
                                        <div class="meta">
                                            <span class="mr-3">1 day ago</span>
                                            <a href="#">Reply</a>
                                        </div>
                                    </div>
                                    <div class="media-right pr-3 align-self-center">
                                        <div class="like text-center">
                                            <i class="ion-heart"></i>
                                            <span>9</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- End 05 -->
                        </ul>
                    </div>
                    <!-- End List -->
                </div>
                <!-- End Widget Body -->
            </div>
            <!-- End Widget 06 -->
        </div>
    </div>
    <!-- End Row -->
    <div class="row flex-row">
        <div class="col-xl-12 os-animation" data-os-animation="fadeInUp">
            <!-- Begin Widget 07 -->
            <div class="widget widget-07 has-shadow">
                <!-- Begin Widget Header -->
                <div class="widget-header bordered d-flex align-items-center">
                    <h2>Product Overview</h2>
                    <div class="widget-options">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary ripple">Week</button>
                            <button type="button" class="btn btn-primary ripple">Month</button>
                        </div>
                    </div>
                </div>
                <!-- End Widget Header -->
                <!-- Begin Widget Body -->
                <div class="widget-body">
                    <div class="table-responsive table-scroll padding-right-10" style="max-height:520px;">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="styled-checkbox mt-2">
                                            <input type="checkbox" name="check-all" id="check-all">
                                            <label for="check-all"></label>
                                        </div>
                                    </th>
                                    <th>Order ID</th>
                                    <th>Customer Name</th>
                                    <th>Country</th>
                                    <th>Ship Date</th>
                                    <th><span style="width:100px;">Status</span></th>
                                    <th>Order Total</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width:5%;">
                                        <div class="styled-checkbox mt-2">
                                            <input type="checkbox" name="cb1" id="cb1">
                                            <label for="cb1"></label>
                                        </div>
                                    </td>
                                    <td><span class="text-primary">054-01-FR</span></td>
                                    <td>Lori Baker</td>
                                    <td>US</td>
                                    <td>10/21/2017</td>
                                    <td><span style="width:100px;"><span class="badge-text badge-text-small info">Paid</span></span></td>
                                    <td>$139.45</td>
                                    <td class="td-actions">
                                        <a href="#"><i class="la la-edit edit"></i></a>
                                        <a href="#"><i class="la la-close delete"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:5%;">
                                        <div class="styled-checkbox mt-2">
                                            <input type="checkbox" name="cb2" id="cb2">
                                            <label for="cb2"></label>
                                        </div>
                                    </td>
                                    <td><span class="text-primary">021-12-US</span></td>
                                    <td>Lawrence Crawford</td>
                                    <td>FR</td>
                                    <td>10/21/2017</td>
                                    <td><span style="width:100px;"><span class="badge-text badge-text-small info">Paid</span></span></td>
                                    <td>$189.00</td>
                                    <td class="td-actions">
                                        <a href="#"><i class="la la-edit edit"></i></a>
                                        <a href="#"><i class="la la-close delete"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:5%;">
                                        <div class="styled-checkbox mt-2">
                                            <input type="checkbox" name="cb3" id="cb3">
                                            <label for="cb3"></label>
                                        </div>
                                    </td>
                                    <td><span class="text-primary">189-01-RU</span></td>
                                    <td>Samuel Walker</td>
                                    <td>AU</td>
                                    <td>08/21/2017</td>
                                    <td><span style="width:100px;"><span class="badge-text badge-text-small danger">Failed</span></span></td>
                                    <td>$107.55</td>
                                    <td class="td-actions">
                                        <a href="#"><i class="la la-edit edit"></i></a>
                                        <a href="#"><i class="la la-close delete"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:5%;">
                                        <div class="styled-checkbox mt-2">
                                            <input type="checkbox" name="cb4" id="cb4">
                                            <label for="cb4"></label>
                                        </div>
                                    </td>
                                    <td><span class="text-primary">092-06-FR</span></td>
                                    <td>Angela Walters</td>
                                    <td>US</td>
                                    <td>08/21/2017</td>
                                    <td><span style="width:100px;"><span class="badge-text badge-text-small success">Delivered</span></span></td>
                                    <td>$129.85</td>
                                    <td class="td-actions">
                                        <a href="#"><i class="la la-edit edit"></i></a>
                                        <a href="#"><i class="la la-close delete"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:5%;">
                                        <div class="styled-checkbox mt-2">
                                            <input type="checkbox" name="cb5" id="cb5">
                                            <label for="cb5"></label>
                                        </div>
                                    </td>
                                    <td><span class="text-primary">021-09-US</span></td>
                                    <td>Ryan Hanson</td>
                                    <td>ES</td>
                                    <td>07/21/2017</td>
                                    <td><span style="width:100px;"><span class="badge-text badge-text-small info">Paid</span></span></td>
                                    <td>$199.95</td>
                                    <td class="td-actions">
                                        <a href="#"><i class="la la-edit edit"></i></a>
                                        <a href="#"><i class="la la-close delete"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:5%;">
                                        <div class="styled-checkbox mt-2">
                                            <input type="checkbox" name="cb6" id="cb6">
                                            <label for="cb6"></label>
                                        </div>
                                    </td>
                                    <td><span class="text-primary">054-01-FR</span></td>
                                    <td>Evelyn Black</td>
                                    <td>FR</td>
                                    <td>10/21/2017</td>
                                    <td><span style="width:100px;"><span class="badge-text badge-text-small info">Paid</span></span></td>
                                    <td>$139.45</td>
                                    <td class="td-actions">
                                        <a href="#"><i class="la la-edit edit"></i></a>
                                        <a href="#"><i class="la la-close delete"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:5%;">
                                        <div class="styled-checkbox mt-2">
                                            <input type="checkbox" name="cb7" id="cb7">
                                            <label for="cb7"></label>
                                        </div>
                                    </td>
                                    <td><span class="text-primary">021-12-US</span></td>
                                    <td>James Morris</td>
                                    <td>EN</td>
                                    <td>10/21/2017</td>
                                    <td><span style="width:100px;"><span class="badge-text badge-text-small info">Paid</span></span></td>
                                    <td>$189.00</td>
                                    <td class="td-actions">
                                        <a href="#"><i class="la la-edit edit"></i></a>
                                        <a href="#"><i class="la la-close delete"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:5%;">
                                        <div class="styled-checkbox mt-2">
                                            <input type="checkbox" name="cb8" id="cb8">
                                            <label for="cb8"></label>
                                        </div>
                                    </td>
                                    <td><span class="text-primary">189-01-RU</span></td>
                                    <td>Valentin H.</td>
                                    <td>AU</td>
                                    <td>08/21/2017</td>
                                    <td><span style="width:100px;"><span class="badge-text badge-text-small danger">Failed</span></span></td>
                                    <td>$107.55</td>
                                    <td class="td-actions">
                                        <a href="#"><i class="la la-edit edit"></i></a>
                                        <a href="#"><i class="la la-close delete"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:5%;">
                                        <div class="styled-checkbox mt-2">
                                            <input type="checkbox" name="cb9" id="cb9">
                                            <label for="cb9"></label>
                                        </div>
                                    </td>
                                    <td><span class="text-primary">092-06-FR</span></td>
                                    <td>Beverly Matthews</td>
                                    <td>RU</td>
                                    <td>08/21/2017</td>
                                    <td><span style="width:100px;"><span class="badge-text badge-text-small info">Paid</span></span></td>
                                    <td>$129.85</td>
                                    <td class="td-actions">
                                        <a href="#"><i class="la la-edit edit"></i></a>
                                        <a href="#"><i class="la la-close delete"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:5%;">
                                        <div class="styled-checkbox mt-2">
                                            <input type="checkbox" name="cb10" id="cb10">
                                            <label for="cb10"></label>
                                        </div>
                                    </td>
                                    <td><span class="text-primary">021-09-US</span></td>
                                    <td>Jeffrey Arnold</td>
                                    <td>US</td>
                                    <td>07/21/2017</td>
                                    <td><span style="width:100px;"><span class="badge-text badge-text-small info">Paid</span></span></td>
                                    <td>$199.95</td>
                                    <td class="td-actions">
                                        <a href="#"><i class="la la-edit edit"></i></a>
                                        <a href="#"><i class="la la-close delete"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- End Widget Body -->
                <!-- Begin Widget Footer -->
                <div class="widget-footer d-flex align-items-center">
                    <div class="mr-auto p-2">
                        <span class="display-items">Showing 1-30 / 150 Results</span>
                    </div>
                    <div class="p-2">
                        <nav aria-label="...">
                            <ul class="pagination justify-content-end">
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="ion-chevron-left"></i></span>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active">
                                    <span class="page-link">2<span class="sr-only">(current)</span></span>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="ion-chevron-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- End Widget Footer -->
            </div>
            <!-- End Widget 07 -->
        </div>
    </div>
    <div class="row flex-row">
        <div class="col-xl-6 col-md-6 os-animation" data-os-animation="fadeInUp">
            <!-- Begin Widget 08 -->
            <div class="widget widget-08 has-shadow">
                <!-- Begin Widget Header -->
                <div class="widget-header bordered d-flex align-items-center">
                    <h2>Tasks List</h2>
                    <div class="widget-options">
                        <div class="dropdown">
                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                                <i class="la la-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item"> 
                                    <i class="la la-plus"></i>Add Task
                                </a>
                                <a href="#" class="dropdown-item"> 
                                    <i class="la la-edit"></i>Edit Widget
                                </a>
                                <a href="#" class="dropdown-item faq"> 
                                    <i class="la la-question-circle"></i>FAQ
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Widget Header -->
                <!-- Begin Widget Body -->
                <div class="widget-body">
                    <div class="today">
                        <div class="title">Today</div>
                        <div class="new-tasks"><span class="nb">12</span> new tasks</div>
                    </div>
                    <!-- Begin List -->
                    <div class="todo-list">
                        <ul id="sortable" class="list">
                            <li class="task-color task-violet">
                                <div class="styled-checkbox">
                                    <input type="checkbox" id="task-1">
                                    <label class="text-primary" for="task-1">Play Rainbow Six</label>
                                </div>
                            </li>
                            <li>
                                <div class="styled-checkbox">
                                    <input type="checkbox" id="task-2">
                                    <label class="text-dark" for="task-2">Drink coffee with Megan</label>
                                </div>
                            </li>
                            <li class="task-color task-blue">
                                <div class="styled-checkbox">
                                    <input type="checkbox" id="task-3">
                                    <label class="text-info" for="task-3">Video conference</label>
                                </div>
                            </li>
                            <li class="task-color task-red">
                                <div class="styled-checkbox">
                                    <input type="checkbox" id="task-4">
                                    <label class="text-danger" for="task-4">Finish visual design</label>
                                </div>
                            </li>
                            <li>
                                <div class="styled-checkbox">
                                    <input type="checkbox" id="task-5">
                                    <label class="text-dark" for="task-5">Meeting with team</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- End List -->
                </div>
                <!-- End Widget Body -->
            </div>
            <!-- End Widget 08 -->
        </div>
        <div class="col-xl-6 col-md-6 os-animation" data-os-animation="fadeInUp">
            <!-- Begin Widget 10 -->
            <div class="widget widget-10 has-shadow">
                <!-- Begin Widget Header -->
                <div class="widget-header bordered d-flex align-items-center">
                    <h2>Support Tickets</h2>
                    <div class="widget-options">
                        <div class="dropdown">
                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                                <i class="la la-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item"> 
                                    <i class="la la-bell-slash"></i>Disable Alerts
                                </a>
                                <a href="#" class="dropdown-item"> 
                                    <i class="la la-edit"></i>Edit Widget
                                </a>
                                <a href="#" class="dropdown-item faq"> 
                                    <i class="la la-question-circle"></i>FAQ
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Widget Header -->
                <!-- Begin Widget Body -->
                <div class="widget-body no-padding">
                    <ul class="ticket list-group w-100">
                        <!-- 01 -->
                        <li class="list-group-item">
                            <div class="media">
                                <div class="media-left align-self-center pr-4">
                                    <img src="assets/img/avatar/avatar-02.jpg" class="user-img rounded-circle" alt="...">
                                </div>
                                <div class="media-body align-self-center">
                                    <div class="username">
                                        <h4>Brandon Smith</h4>
                                    </div>
                                    <div class="msg">
                                        <p>
                                            Hello, Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et mauris sapien sem, ornare id mauris vitae, ultricies volutpat ...
                                        </p>
                                    </div>
                                    <div class="status"><span class="open mr-2">Open</span>(1 hour ago)</div>
                                </div>
                            </div>
                        </li>
                        <!-- End 01 -->
                        <!-- 02 -->
                        <li class="list-group-item">
                            <div class="media">
                                <div class="media-left align-self-center pr-4">
                                    <img src="assets/img/avatar/avatar-04.jpg" class="user-img rounded-circle" alt="...">
                                </div>
                                <div class="media-body align-self-center">
                                    <div class="username">
                                        <h4>Nathan Hunter</h4>
                                    </div>
                                    <div class="msg">
                                        <p>
                                            Hello, Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et mauris sapien sem, ornare id mauris vitae, ultricies volutpat ...
                                        </p>
                                    </div>
                                    <div class="status"><span class="pending mr-2">Pending</span>(2 hours ago)</div>
                                </div>
                            </div>
                        </li>
                        <!-- End 02 -->
                        <!-- 03 -->
                        <li class="list-group-item">
                            <div class="media">
                                <div class="media-left align-self-center pr-4">
                                    <img src="assets/img/avatar/avatar-05.jpg" class="user-img rounded-circle" alt="...">
                                </div>
                                <div class="media-body align-self-center">
                                    <div class="username">
                                        <h4>Megan Duncan</h4>
                                    </div>
                                    <div class="msg">
                                        <p>
                                            Hello, Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et mauris sapien sem, ornare id mauris vitae, ultricies volutpat ...
                                        </p>
                                    </div>
                                    <div class="status"><span class="closed mr-2">Closed</span>(1 day ago)</div>
                                </div>
                            </div>
                        </li>
                        <!-- End 03 -->
                    </ul>
                </div>
                <!-- End Widget Body -->
            </div>
            <!-- End Widget 10 -->
        </div>
    </div>
    <!-- End Row -->
    
@endsection
