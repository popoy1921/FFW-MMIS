<!DOCTYPE html>
<html lang="en">

<head>
	@include('common.headerpublic')
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-6 col-md-9 my-3">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

	@include('common.footerpublic')

</body>

</html>