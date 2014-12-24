<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
</head>
<body>
	<div>
		<p>
            Заявка на участие в конкурсе архитекторов
		</p>

		@if (@count($nomination))
		<p>
			<b>Номинации:</b><br/>
			@if (@$nomination['ecohouse'])
				- Экодом;<br/>
			@endif
			@if (@$nomination['landscape'])
				- Ландшафтная архитектура;<br/>
			@endif
		</p>
		@endif

		@if (@$projname)
		<p>
			<b>Название проекта:</b><br/>
			{{ $projname }}
		</p>
		@endif

		@if (@$zname)
		<p>
			<b>Заявитель:</b><br/>
			{{ $zname }}
		</p>
		@endif

		@if (@$address)
		<p>
			<b>Адрес:</b><br/>
			{{ $address }}
		</p>
		@endif

		@if (@$email)
		<p>
			<b>e-mail:</b><br/>
			{{ $email }}
		</p>
		@endif

		@if (@$phone)
		<p>
			<b>Телефон:</b><br/>
			{{ $phone }}
		</p>
		@endif

		@if (@$site)
		<p>
			<b>Веб-сайт:</b><br/>
			{{ $site }}
		</p>
		@endif



		@if (@$rname)
			<p>
				<b>ФИО руководителя проекта:</b><br/>
				{{ $rname }}
			</p>
		@endif

		@if (@$rplace)
			<p>
				<b>Должность:</b><br/>
				{{ $rplace }}
			</p>
		@endif

		@if (@$remail)
			<p>
				<b>e-mail руководителя:</b><br/>
				{{ $remail }}
			</p>
		@endif

		@if (@$rphone)
			<p>
				<b>Телефон руководителя:</b><br/>
				{{ $rphone }}
			</p>
		@endif

		@if (@$aboutpeople)
			<p>
				<b>О коллективе:</b><br/>
				{{ $aboutpeople }}
			</p>
		@endif

	</div>
</body>
</html>