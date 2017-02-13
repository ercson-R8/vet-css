

{% block body %}

    <h1>Login</h1>
	<span>or <a href="/auth/RegisterController/index">register here</a></span>
	<form action="/auth/LoginController/authenticate" method="POST">
		<br/>
		<input type="text" placeholder="Enter your email" name="email">
        <br/>
		<input type="password" placeholder="and password" name="password">
        <br/>
		<input type="submit">
		

	</form>

{% endblock %}

