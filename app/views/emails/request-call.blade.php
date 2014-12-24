<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
</head>
<body>
	<div>
		<p>
            Заказан обратный звонок на номер {{ $phone }}
    		@if ($name)
    			({{ $name }})
    		@endif
		</p>
		@if ($phone)
		<p>
			Комментарий:
		</p>
		<p>
			{{ Helper::nl2br($text) }}
		</p>
		@endif
	</div>
</body>
</html>