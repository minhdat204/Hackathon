<!--header-->
<header class="header">
    <div class="container-fluid bg-light py-4 px-5">
        <div class="header_container">
            <div class="col-lg-6">
                <h1 class="display-4 text-dark" style="font-weight: 500">
                    <img src="/img/banner/bannerHack.png" alt=".." width="100%" />
                </h1>
                <p class="lead"></p>
                <div style="display:flex; justify-content:first baseline" class="align-items-center">
                    <div class="button-wrapper" data-tippy-content="Click to copy button 49" style="margin-right: 5rem">
                        @if ($data['islike'] === 1)
                            <button class="button-49 neon-button" role="button" id="">
                                Đã bình chọn
                            </button>
                        @elseif ($data['islike'] === 0)
                            <button class="button-49 neon-button" role="button" id="voteButton">
                                Bình chọn
                            </button>
                        @endif
                    </div>

                    <div class="button-wrapper" data-tippy-content="Click to copy button 49">
                        {{-- <button class="button-49 neon-button" role="button" id=""
                            style="background:rgb(98, 12, 238); border-radius: 10px">
                            <span id="followers"> {{ $data['count'] }}</span> followers
                        </button> --}}

                        <button class="buttonShowFollow"><span id="followers"> {{ $data['count'] }}</span>
                            followers</button>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="illustration">
                    <div class="position-relative">
                        <img class="img-fluid" src="img/frame.svg" alt="Illustration" />
                        <div class="header_absolute header_img">
                            <img class="img-fluid header_img2" src="img/frame-1.svg" alt="Additional Frame" />
                            <img class="group mw-100" src="/img/banner/logocdth22webb.png" class="img-fluid"
                                alt="Group Image" style="width: 70%" />
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
