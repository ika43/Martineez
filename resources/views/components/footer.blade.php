<footer class="footer @if(session()->has('admin')) admin-footer @endif">
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="row text-center">
                    <div class="col-sm footer-text p-2">
                        <p>About Us</p>
                        <small>
                            We are social network only for caterer's. Here we don't post pic about us, we make some masterpiece
                            of our work, like some cocktail, dishes or everything else from restaurant, bar, hotel, etc. Take a photo and share with others here.
                        </small>
                    </div>
                    <div class="col-sm footer-text p-2 mb-5">
                        <p>Contact us</p>
                        <small>
                            11210 Belgrade, Serbia</br>
                            <a href="https://www.facebook.com/profile.php?id=1187541917"><img src="{{asset('images/facebook.png')}}" class="mt-3 relIco"/></a>
                            <a href="https://www.linkedin.com/in/ivan-laba-aa3b91131/"><img src="{{asset('images/linked.png')}}" class="mt-3 relIco"/></a>
                        </small>
                    </div>
                    <div class="col-sm footer-text p-2 mb-5">
                        <p>Navigation</p>
                        <ul class="list-group" style="list-style: none">
                            <li><a href="{{url('/')."/author"}}" class="footer-text">About me</a></li>
                             <li><a href="@if(session()->has('admin')){{url('/admin/docs')}}@endif" class="footer-text">Docs(Log as Admin)</a></li>
                            @if(!session()->has('user') && !session()->has('admin'))
                            <li><a href="{{url('/')."/showLog"}}" class="footer-text">Login</a></li>
                            <li><a href="{{url('/')}}" class="footer-text">Register</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container mb-2 text-center">
                <p class="footer-text m-1 mb-3">&#169; 2018 Martineez. All rights reserved. Covered by Laba Patent.</p>
                <small>
                    <a href="#" class="footer-text after">Privacy Policy</a>
                    <a href="#" class="footer-text after">Support</a>
                    <a href="#" class="footer-text">Term of Use</a>
                </small>
            </div>
        </div>
    </div>
</footer>
<style>
    .footer {
        background-color: #333;
    }
    .footer-text{
        color: #999;
    }
    .footer-text:hover{
        text-decoration: none;
        color: #999;
    }
    .after::after {
        content: " | ";
    }
    .admin-footer{
        margin-top:auto;
    }
    .relIco{
        opacity: 0.5;
    }
</style>