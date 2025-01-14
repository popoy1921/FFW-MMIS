<!DOCTYPE html>
<html lang="en">

<head>
	@include('common.headerpublic')
</head>

<body class="bg-gradient-primary">

    <div class="container h-100">

        <!-- Outer Row -->
        <div class="row align-items-center h-100">

            <div class="col-lg-6 col-md-9 col-sm-12 mx-auto">

                <div class="card h-100 justify-content-center o-hidden border-0 shadow-lg">
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