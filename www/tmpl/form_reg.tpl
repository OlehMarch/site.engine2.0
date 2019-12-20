<h1>Регистрация</h1>
%message%
<div id="reg">
	<form name="reg" action="functions.php" method="post">
		<table>
			<tr>
				<td class="label">Логин:</td>
				<td>
					<input type="text" name="login" value="%login%" />
				</td>
			</tr>
			<tr>
				<td class="label">Пароль:</td>
				<td>
					<input type="password" name="password" />
				</td>
			</tr>
			<tr>
				<td class="label">E-Mail:</td>
				<td>
					<input type="text" name="email" />
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<img src="captcha.php" alt="Каптча" />
				</td>
			</tr>
			<tr>
				<td class="label">Проверочный код:</td>
				<td>
					<input type="text" name="captcha" />
				</td>
			</tr>
			<tr>
				<td colspan="2" align="right">
					<input type="submit" name="reg" value="Зарегистрироватся" />
				</td>
			</tr>
		</table>
	</form>
</div>