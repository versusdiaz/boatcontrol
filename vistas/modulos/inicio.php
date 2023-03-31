<body class="app flex-row align-items-center fondoATM">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-group">
            <div class="card p-4">
              <div class="card-body">
                <h1>Login</h1>
                <p class="text-muted">Ingrese con su cuenta</p>
                <form method="post" id="frmAcceso">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-user"></i>
                    </span>
                  </div>
                  <input class="form-control" type="text" placeholder="Username" id='login' >
                </div>
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-lock"></i>
                    </span>
                  </div>
                  <input class="form-control" type="password" placeholder="Password" id='clave' >
                </div>
                <div class="row">
                  <div class="col-6">
                    <button class="btn btn-primary px-4" type="submit">Login</button>
                  </div>
                </div>
                </form>
              </div>
            </div>
            <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
              <div class="card-body text-center">
                <div>
                  <h2>BoatControl</h2>
                  <p>Sistema elaborado para el control del mantenimiento de embarcaciones</p>
                  <button class="btn btn-primary active mt-3" type="button">Info</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="vistas/plugins/jquery/jquery.min.js"></script>
    <script src="vistas/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="vistas/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="vistas/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="vistas/plugins/bootstrap/js/popper.min.js"></script>
    <script type="text/javascript" src="vistas/js/login.js"></script>
