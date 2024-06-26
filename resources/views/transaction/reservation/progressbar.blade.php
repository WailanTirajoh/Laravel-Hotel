<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <ul class="progress-indicator m-4">
                    <li
                        class="{{ Route::currentRouteName() == 'transaction.reservation.createIdentity' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.pickFromCustomer' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.viewCountPerson' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.chooseRoom' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.confirmation' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.payDownPayment' ? 'completed' : '' }}">
                        <span class="bubble"></span> Registro 
                    </li>
                    <li
                        class="{{ Route::currentRouteName() == 'transaction.reservation.viewCountPerson' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.chooseRoom' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.confirmation' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.payDownPayment' ? 'completed' : '' }}">
                        <span class="bubble"></span> Cuantas Personas?
                    </li>
                    <li
                        class="{{ Route::currentRouteName() == 'transaction.reservation.chooseRoom' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.confirmation' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.payDownPayment' ? 'completed' : '' }}">
                        <span class="bubble"></span> Elige un Cuarto
                    </li>
                    <li
                        class="{{ Route::currentRouteName() == 'transaction.reservation.confirmation' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.payDownPayment' ? 'completed' : '' }}">
                        <span class="bubble"></span> Confirmación
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
