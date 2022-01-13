<div class="connect alert alert-primary">
    <div class="d-flex align-items-center">
        <span id="alert"><?=$name[0]['name']?></span>
        <div class="spinner-border text-primary ms-auto d-none" role="status" aria-hidden="true"></div>
    </div>
</div>
<form id="chat">
    <input type="file">
    <div class="messages mb-2 form-control"></div>
    <div class="d-flex mb-2">
        <input type="text" name="message" class="message form-control form-control-lg" placeholder="введите сообщение">
        <button type="button" class="btn ml-3 btn-lg btn-outline-primary ms-2 btn--mic mike">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="30px" style="enable-background:new 0 0 85 151;" version="1.1" viewBox="0 0 85 151" width="20px" xml:space="preserve">
                <style type="text/css">
                    <![CDATA[
                    .st0 {
                        fill: #EF3E42;
                    }

                    .st1 {
                        fill: #FFFFFF;
                    }

                    .st2 {
                        fill: none;
                    }

                    .st3 {
                        fill-rule: evenodd;
                        clip-rule: evenodd;
                        fill: #FFFFFF;
                    }
                    ]]>
                </style>
                <defs />
                <path class="svg-mike" fill="#0d6efd" d="M43.9,90.5c-8.9,0-16.1-7.3-16.1-16.2V37.9c0-9,7.2-16.2,16.1-16.2C52.8,21.7,60,29,60,37.9v36.3  C60,83.2,52.8,90.5,43.9,90.5L43.9,90.5z M65.8,64h10.8v13.8c0,15.4-12.1,28.1-27.3,29v11.3h16.2v10.8H22.3v-10.8h16.2v-11.3  c-15.2-0.9-27.3-13.6-27.3-29V64h10.8v13.8c0,10.1,8.2,18.2,18.2,18.2h7.3c10.1,0,18.2-8.2,18.2-18.2V64L65.8,64z" />
                <rect class="st2" height="30" id="_x3C_Slice_x3E__100_" width="20" />
            </svg>
        </button>
        <?var_dump($arResult);?>
    </div>
    <button id="send-message" class="btn mb-4 btn-lg btn-outline-primary">отправить</button>
</form>