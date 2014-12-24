<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
</head>
<body>
	<div>
		<p>
            Сообщение от &lt;{{ $email }}&gt;
		</p>
		@if ($phone)
		<p>
			Телефон: {{ $phone }}
		</p>
		@endif
		<p>
			Текст сообщения:
		</p>
		<p>
			{{ Helper::nl2br($text) }}
		</p>
	</div>
</body>
</html>