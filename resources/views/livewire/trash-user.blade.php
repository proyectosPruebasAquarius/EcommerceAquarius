<div>
    <div class="row">
        <div class="col-12">
            <h6>
                Al eliminar tú cuenta no podras registrarte haciendo uso del mismo correo. Como {{ env('APP_NAME') }} lamentamos que te vayas, esperamos mejorar cada dia más por la sastifación de nuestros clientes, esperamos que vuelvas.
                A continuación se muestra el botón donde aceptas el eliminar tú cuenta.
                <br/>
                - ATT: El equipo de {{ env('APP_NAME') }} 
            </h6>
        </div>
        <div class="col-12 mx-auto text-center">
            <button class="btn btn-primary" wire:click="acceptTrash()">Acepto</button>
        </div>
    </div>
</div>
