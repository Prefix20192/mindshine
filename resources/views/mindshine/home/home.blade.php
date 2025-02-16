<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>MindShine - Бот для игровых проектов.</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="{{asset('assets/img/favicon.ico')}}" rel="icon">
    <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800"
          rel="stylesheet">
    <link href="{{asset('assets/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/lib/venobox/venobox.css')}}" rel="stylesheet">
    <link href="{{asset('assets/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
</head>
<body>
    <header id="header">
        <div class="container">

            <div id="logo" class="pull-left">
                <h1><a href="/"><span>M</span>ind<span>S</span>hine</a></h1>
                <!-- <a href="#intro" class="scrollto"><img src="img/logo.png" alt="" title=""></a> -->
            </div>

            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class="menu-active"><a href="#intro">Главная</a></li>
                    <li><a href="#about">Описание</a></li>
                    <li><a href="#about">Тарифы</a></li>
                    <li><a href="#about">О нас</a></li>
                    <li><a href="#speakers">Клиенты</a></li>
                    <li><a href="#reviews">Отзывы</a></li>
                    <li class="buy-tickets"><a data-toggle="modal" data-target="#authRegister" href="#">Авторизация \ Регистрация</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="intro">
        <div class="intro-container wow fadeIn">
            <h1 class="mb-4 pb-0">Бот <span>MINDSHINE</span> для игровых проектов.</h1>
            <p class="mb-4 pb-0">Кроссплатформенный бот для мессенджеров «ВКонтакте» и «Telegram».</p>
        </div>
    </section>

    <main id="main">
        <section id="reviews" class="section-with-bg wow fadeInUp">
            <div class="container">
                <div class="section-header">
                    <h2>Отзывы</h2>
                    <p>Отзывы от пользователей которые используют бота.</p>
                </div>

                <!-- <div class="row">

                  <div class="col-lg-4 col-md-6">
                    <div class="hotel">
                      <div class="hotel-img">
                        <img src="img/hotels/1.jpg" alt="Hotel 1" class="img-fluid">
                      </div>
                      <h3><a href="#">Hotel 1</a></h3>
                      <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <p>0.4 Mile from the Venue</p>
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-6">
                    <div class="hotel">
                      <div class="hotel-img">
                        <img src="img/hotels/2.jpg" alt="Hotel 2" class="img-fluid">
                      </div>
                      <h3><a href="#">Hotel 2</a></h3>
                      <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-full"></i>
                      </div>
                      <p>0.5 Mile from the Venue</p>
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-6">
                    <div class="hotel">
                      <div class="hotel-img">
                        <img src="img/hotels/3.jpg" alt="Hotel 3" class="img-fluid">
                      </div>
                      <h3><a href="#">Hotel 3</a></h3>
                      <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <p>0.6 Mile from the Venue</p>
                    </div>
                  </div>

                </div> -->
            </div>
        </section>

        <section id="buy-tickets" class="section-with-bg wow fadeInUp">
            <div class="container">
                <div class="section-header">
                    <h2>Покупка подписки</h2>
                    <p>Покупая подписку на бота вы помогаете развитию проекта.</p>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-5 mb-lg-0">
                            <div class="card-body">
                                <h5 class="card-title text-muted text-uppercase text-center">Standard Access</h5>
                                <h6 class="card-price text-center">$150</h6>
                                <hr>
                                <ul class="fa-ul">
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Regular Seating</li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Coffee Break</li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Custom Badge</li>
                                    <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Community Access</li>
                                    <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Workshop Access</li>
                                    <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>After Party</li>
                                </ul>
                                <hr>
                                <div class="text-center">
                                    <button type="button" class="btn" data-toggle="modal" data-target="#buy-ticket-modal"
                                            data-ticket-type="standard-access">Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card mb-5 mb-lg-0">
                            <div class="card-body">
                                <h5 class="card-title text-muted text-uppercase text-center">Pro Access</h5>
                                <h6 class="card-price text-center">$250</h6>
                                <hr>
                                <ul class="fa-ul">
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Regular Seating</li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Coffee Break</li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Custom Badge</li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Community Access</li>
                                    <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Workshop Access</li>
                                    <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>After Party</li>
                                </ul>
                                <hr>
                                <div class="text-center">
                                    <button type="button" class="btn" data-toggle="modal" data-target="#buy-ticket-modal"
                                            data-ticket-type="pro-access">Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pro Tier -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-muted text-uppercase text-center">Premium Access</h5>
                                <h6 class="card-price text-center">$350</h6>
                                <hr>
                                <ul class="fa-ul">
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Regular Seating</li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Coffee Break</li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Custom Badge</li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Community Access</li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Workshop Access</li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>After Party</li>
                                </ul>
                                <hr>
                                <div class="text-center">
                                    <button type="button" class="btn" data-toggle="modal" data-target="#buy-ticket-modal"
                                            data-ticket-type="premium-access">Buy Now</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- <section id="supporters" class="section-with-bg wow fadeInUp">
          <div class="container">
            <div class="section-header">
              <h2>Sponsors</h2>
            </div>

            <div class="row no-gutters supporters-wrap clearfix">

              <div class="col-lg-3 col-md-4 col-xs-6">
                <div class="supporter-logo">
                  <img src="img/supporters/1.png" class="img-fluid" alt="">
                </div>
              </div>

              <div class="col-lg-3 col-md-4 col-xs-6">
                <div class="supporter-logo">
                  <img src="img/supporters/2.png" class="img-fluid" alt="">
                </div>
              </div>

              <div class="col-lg-3 col-md-4 col-xs-6">
                <div class="supporter-logo">
                  <img src="img/supporters/3.png" class="img-fluid" alt="">
                </div>
              </div>

              <div class="col-lg-3 col-md-4 col-xs-6">
                <div class="supporter-logo">
                  <img src="img/supporters/4.png" class="img-fluid" alt="">
                </div>
              </div>

              <div class="col-lg-3 col-md-4 col-xs-6">
                <div class="supporter-logo">
                  <img src="img/supporters/5.png" class="img-fluid" alt="">
                </div>
              </div>

              <div class="col-lg-3 col-md-4 col-xs-6">
                <div class="supporter-logo">
                  <img src="img/supporters/6.png" class="img-fluid" alt="">
                </div>
              </div>

              <div class="col-lg-3 col-md-4 col-xs-6">
                <div class="supporter-logo">
                  <img src="img/supporters/7.png" class="img-fluid" alt="">
                </div>
              </div>

              <div class="col-lg-3 col-md-4 col-xs-6">
                <div class="supporter-logo">
                  <img src="img/supporters/8.png" class="img-fluid" alt="">
                </div>
              </div>

            </div>

          </div>

        </section> -->

        <section id="faq" class="wow fadeInUp">
            <div class="container">

                <div class="section-header">
                    <h2>F.A.Q </h2>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <ul id="faq-list">

                            <li>
                                <a data-toggle="collapse" class="collapsed" href="#faq1">Non consectetur a erat nam at lectus urna duis?
                                    <i class="fa fa-minus-circle"></i></a>
                                <div id="faq1" class="collapse" data-parent="#faq-list">
                                    <p>
                                        Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur
                                        gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <a data-toggle="collapse" href="#faq2" class="collapsed">Feugiat scelerisque varius morbi enim nunc
                                    faucibus a pellentesque? <i class="fa fa-minus-circle"></i></a>
                                <div id="faq2" class="collapse" data-parent="#faq-list">
                                    <p>
                                        Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id
                                        donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque
                                        elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <a data-toggle="collapse" href="#faq3" class="collapsed">Dolor sit amet consectetur adipiscing elit
                                    pellentesque habitant morbi? <i class="fa fa-minus-circle"></i></a>
                                <div id="faq3" class="collapse" data-parent="#faq-list">
                                    <p>
                                        Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar
                                        elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque
                                        eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis
                                        sed odio morbi quis
                                    </p>
                                </div>
                            </li>

                            <li>
                                <a data-toggle="collapse" href="#faq4" class="collapsed">Ac odio tempor orci dapibus. Aliquam eleifend
                                    mi in nulla? <i class="fa fa-minus-circle"></i></a>
                                <div id="faq4" class="collapse" data-parent="#faq-list">
                                    <p>
                                        Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id
                                        donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque
                                        elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <a data-toggle="collapse" href="#faq5" class="collapsed">Tempus quam pellentesque nec nam aliquam sem et
                                    tortor consequat? <i class="fa fa-minus-circle"></i></a>
                                <div id="faq5" class="collapse" data-parent="#faq-list">
                                    <p>
                                        Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in.
                                        Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est.
                                        Purus gravida quis blandit turpis cursus in
                                    </p>
                                </div>
                            </li>

                            <li>
                                <a data-toggle="collapse" href="#faq6" class="collapsed">Tortor vitae purus faucibus ornare. Varius vel
                                    pharetra vel turpis nunc eget lorem dolor? <i class="fa fa-minus-circle"></i></a>
                                <div id="faq6" class="collapse" data-parent="#faq-list">
                                    <p>
                                        Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada
                                        nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut
                                        venenatis tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas
                                        egestas fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit massa enim nec.
                                    </p>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </section>


        <div id="authRegister" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Buy Tickets</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="#">
                            <div class="form-group">
                                <input type="text" class="form-control" name="your-name" placeholder="Your Name">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="your-email" placeholder="Your Email">
                            </div>
                            <div class="form-group">
                                <select id="ticket-type" name="ticket-type" class="form-control" >
                                    <option value="">-- Select Your Ticket Type --</option>
                                    <option value="standard-access">Standard Access</option>
                                    <option value="pro-access">Pro Access</option>
                                    <option value="premium-access">Premium Access</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn">Авторизация</button>
                                <button type="submit" class="btn">Регистрация</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 footer-info">
                        <img src="{{asset('assets/img/favicon.ico')}}" alt="MindShine">
                        <p>Проект по созданию ботов которые облегчут работу владельцов игровых проектов.</p>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h4>Нас можно найти тут</h4>
                        <div class="social-links">
                            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Пользовательские ссылки</h4>
                        <ul>
                            <li><i class="fa fa-angle-right"></i> <a href="#">Главная</a></li>
                            <li><i class="fa fa-angle-right"></i> <a href="#">Описание</a></li>
                            <li><i class="fa fa-angle-right"></i> <a href="#">Тарифы</a></li>
                            <li><i class="fa fa-angle-right"></i> <a href="#">О нас</a></li>
                            <li><i class="fa fa-angle-right"></i> <a href="#">Клиенты</a></li>
                            <li><i class="fa fa-angle-right"></i> <a href="#">Отзывы</a></li>
                        </ul>
                    </div>

                    <!-- <div class="col-lg-3 col-md-6 footer-links">
                      <h4>Useful Links</h4>
                      <ul>
                        <li><i class="fa fa-angle-right"></i> <a href="#">Home</a></li>
                        <li><i class="fa fa-angle-right"></i> <a href="#">About us</a></li>
                        <li><i class="fa fa-angle-right"></i> <a href="#">Services</a></li>
                        <li><i class="fa fa-angle-right"></i> <a href="#">Terms of service</a></li>
                        <li><i class="fa fa-angle-right"></i> <a href="#">Privacy policy</a></li>
                      </ul>
                    </div> -->
                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span style="color: red;">M</span>ind<span style="color: red;">S</span>hine</strong>. Все права защищены
            </div>
        </div>
    </footer>

    <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

    {{--  JS SCRIPTS  --}}
    <script src="{{asset('assets/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/lib/jquery/jquery-migrate.min.js')}}"></script>
    <script src="{{asset('assets/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('assets/lib/superfish/hoverIntent.js')}}"></script>
    <script src="{{asset('assets/lib/superfish/superfish.min.js')}}"></script>
    <script src="{{asset('assets/lib/wow/wow.min.js')}}"></script>
    <script src="{{asset('assets/lib/venobox/venobox.min.js')}}"></script>
    <script src="{{asset('assets/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <script src="{{asset('assets/contactform/contactform.js')}}"></script>

    <script src="{{asset('assets/js/main.js')}}"></script>
</body>
</html>
