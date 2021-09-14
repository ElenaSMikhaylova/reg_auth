<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="category">
  <div class="container h-100">
    <div class="blog-banner">
      <div class="text-center">
        <h1>Вход / Регистрация</h1>
        <nav aria-label="breadcrumb" class="banner-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Главная</a></li>
            <li class="breadcrumb-item active" aria-current="page">
              Вход/Регистрация
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</section>
<!-- ================ end banner area ================= -->

<!--================Login Box Area =================-->
<section class="login_box_area section-margin">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="login_box_img">
          <div class="hover">
            <h4>Впервые на нашем сайте?</h4>
            <p>
              Создайте аккаунт, заполнив небольшую форму на странице регистрации
            </p>
            <a class="button button-account" href="/reg">Создать аккаунт</a>
          </div>
        </div>
      </div>


      <div class="col-lg-6">
        <div class="login_form_inner">
          <h3>Авторизоваться для входа</h3>

          <form class="row login_form" onsubmit="sendForm(this); return false;">
            <div class="col-md-12 form-group">
              <input type="text" class="form-control" id="email" name="email" placeholder="E-mail" />
            </div>
            <div class="col-md-12 form-group">
              <input type="password" class="form-control" id="pass" name="pass" placeholder="Пароль" />
              <p id="info" style="color: red"></p>
            </div>

            <div class="col-md-12 form-group">
              <div class="creat_account">
                <input type="checkbox" id="f-option2" name="selector" />
                <label for="f-option2">Сохранять пароль</label>
              </div>
            </div>


            <div class="col-md-12 form-group">
              <button type="submit" value="submit" class="button button-login w-100">
                Войти
              </button>
              <a href="#">Забыли пароль?</a>
            </div>


          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Login Box Area =================-->


<script>
  async function sendForm(form) {
    info.innerText = ``;
    let formData = new FormData(form);
    let responce = await fetch("authUser", {
      method: "POST",
      body: formData,
    });

    let res = await responce.json();
    if (res.otvet == "ok") {

      location.href = "users/profile";

    } else if (res.otvet == "user_not_found") {
      info.innerText = `неправильный логин или пароль`;
    } else {
      alert("неизвестная ошибка");
    }

  }
</script>