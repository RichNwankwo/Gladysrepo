<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <link rel="stylesheet" href="/css/app.css">
    <title>Gladys - Learning Tool</title>
  </head>
  <body>
    <section>
      <ul class="nav nav-tabs">
        <li class="active">Home</li>
        <li>Facts</li>
        <li>Questions</li>
      </ul>
    </section>
    <h1>Gladys</h1>
    <section>
      <p>POST api/v1/Fact/</p>
      <form action="api/v1/fact" method="POST">
        <input type="hidden" name="_token" value="&lt;?php echo csrf_token();?&gt;">
        <div>
          <label for="fact">Fact:</label>
          <input id="fact" type="text" name="fact">
        </div>
        <button type="submit">Submit</button>
      </form>
    </section>
    <section>
      <p>GET app/v1/fact/</p><a href="api/v1/fact">Get all facts</a>
    </section>
    <section>
      <p>Get fact</p><a href="api/v1/fact/1">Get fact with id = 1</a>
    </section>
  </body>
</html>