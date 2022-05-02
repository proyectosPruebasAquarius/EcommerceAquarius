@extends('app')

@section('title', 'Políticas del Sitio')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
<li class="breadcrumb-item active" aria-current="page">Políticas del Sitio</li>
@endsection

@section('content')
    <section>
        <div class="container pt-5 pb-5">
            <div class="row align-items-center">
                {{-- <div class="col-12">
                    <h3>Seguridad de Sitio</h3>
                    <p>
                        

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam commodo et orci ut mollis. Quisque varius orci tellus. Sed in molestie est, et consectetur libero. Sed laoreet efficitur massa ut tincidunt. Curabitur quis venenatis mi. Vivamus tellus ex, varius quis consequat sed, aliquam non ex. Maecenas et finibus nisl. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consequat lacinia ex eu tincidunt. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Interdum et malesuada fames ac ante ipsum primis in faucibus. In luctus lectus et diam dictum consectetur.

Phasellus ut libero rutrum, aliquet felis et, tristique augue. Proin interdum sit amet metus vulputate auctor. Pellentesque tincidunt nisi sed mauris luctus, in ornare enim interdum. Phasellus tincidunt rhoncus elit porttitor maximus. Pellentesque tempor, eros nec vehicula mattis, purus magna dignissim diam, nec tincidunt erat elit a augue. Duis ac cursus turpis. Donec arcu risus, venenatis vitae auctor non, laoreet in metus. Mauris porta lectus eget gravida convallis. Nam orci orci, dignissim at feugiat malesuada, fermentum ut odio. Fusce massa ipsum, iaculis nec aliquet ut, luctus et erat. Proin egestas mauris quis pellentesque elementum. Morbi vel feugiat libero, bibendum maximus dolor. Sed risus dolor, cursus ac hendrerit vitae, tincidunt id dolor. Sed. 
                    </p>
                </div>
                <div class="col-12 mt-3">
                    <h3>Garantias</h3>
                    <p>
                        

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam commodo et orci ut mollis. Quisque varius orci tellus. Sed in molestie est, et consectetur libero. Sed laoreet efficitur massa ut tincidunt. Curabitur quis venenatis mi. Vivamus tellus ex, varius quis consequat sed, aliquam non ex. Maecenas et finibus nisl. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consequat lacinia ex eu tincidunt. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Interdum et malesuada fames ac ante ipsum primis in faucibus. In luctus lectus et diam dictum consectetur.

Phasellus ut libero rutrum, aliquet felis et, tristique augue. Proin interdum sit amet metus vulputate auctor. Pellentesque tincidunt nisi sed mauris luctus, in ornare enim interdum. Phasellus tincidunt rhoncus elit porttitor maximus. Pellentesque tempor, eros nec vehicula mattis, purus magna dignissim diam, nec tincidunt erat elit a augue. Duis ac cursus turpis. Donec arcu risus, venenatis vitae auctor non, laoreet in metus. Mauris porta lectus eget gravida convallis. Nam orci orci, dignissim at feugiat malesuada, fermentum ut odio. Fusce massa ipsum, iaculis nec aliquet ut, luctus et erat. Proin egestas mauris quis pellentesque elementum. Morbi vel feugiat libero, bibendum maximus dolor. Sed risus dolor, cursus ac hendrerit vitae, tincidunt id dolor. Sed. 
                    </p>
                </div> --}}
                <div class="col-12 mt-3">
                    <h3>Política de Privacidad</h3>
                    <p style="text-align: justify; text-justify: inter-word;">
                        En Aquarius IT, S.A. de C.V., agradecemos tu confianza, te garantizamos que los datos personales que tú nos proporcionas de forma libre y voluntaria los usaremos de una forma leal y lícita. 
                        En la presente política de privacidad, Aquarius IT, S.A. de C.V., establece los términos en que usa y protege la información que tú nos proporcionas como usuario al momento de utilizar nuestra web, en la cual, podremos obtener tu  Nombre, correo electrónico, teléfono, nombre de la empresa, NIT de la empresa,  lo hacemos asegurando que sólo se empleará de acuerdo con fines legítimos, en su tratamiento aplicamos los principios que establece la ley (citar en este párrafo la ley), respetando en todo momento los límites legales de la normativa. 
                        <ul class="politicas">
                            <li>
                                <span>1.5 Eliminar Mi Cuenta</span>
                                Para eliminar tú cuenta comunicate con nuestro equipo de soporte atravez del siguiente enlace <a href="{{ route('eliminar.cuenta.form') }}">{{ route('eliminar.cuenta.form') }}</a>, rellena el formulario y se te enviara un enlace de confirmación a tú correo, recuerda que debes estar autenticado en tú cuenta.
                            </li>
                            <li>
                                <span>
                                    ¿Qué hacemos con tus datos?
                                </span>
                                La finalidad de tratar tus datos es para proporcionarte el mejor servicio posible, conocer más cuáles son tus requerimientos en cuanto a la web de tu negocio, la app que requieres o el servicio de marketing que necesitas. Es posible que sean enviados correos electrónicos periódicamente a través de nuestro sitio con ofertas especiales y otra información publicitaria que consideremos relevante para ti o que pueda brindarte algún beneficio, estos correos electrónicos serán enviados a la dirección que nos has proporcionado.
                                En Aquarius IT, S.A. de C.V., estamos altamente comprometidos para proteger tu información. Usamos sistemas avanzados y los actualizamos constantemente para asegurarnos que no exista ningún acceso no autorizado.
                            </li>
                            <li>
                                <span>
                                    Tu consentimiento
                                </span>
                                Al usar nuestro sitio web, aceptas los términos de esta Política de Privacidad para que Aquarius IT, S.A. de C.V., haga el tratamiento de tus datos personales que derivan de una relación contractual profesional siendo necesarios para su contratación, desarrollo y cumplimiento. 
                                Este consentimiento puede ser revocado, sin efecto retroactivo. 
                            </li>
                            <li>
                                <span>
                                    Cookies
                                </span>
                                Una cookie es un archivo de tamaño pequeño enviado por un sitio web y almacenado en el navegador del usuario, de manera que el sitio web puede consultar la actividad previa del navegador. Así, es posible identificar al usuario que visita un sitio web y llevar un registro de su actividad en el mismo y hacer que su experiencia en línea sea más sencilla. Las funciones de las cookies pueden ser muy variadas: desde almacenar datos de la sesión abierta y otras funcionalidades técnicas, como guardar preferencias de navegación, recopilar información estadística, información sobre el equipo, etc.
                                Algunos tipos de cookies
<span>Cookies de sesión:</span> son las más efímeras, se eliminan cuando el usuario cierra el navegador.

<span>Cookies persistentes:</span> no se borran al cerrar el navegador, permanecen en los sistemas cliente hasta una fecha de caducidad o cuando el usuario elimina sus datos de navegación.

Nuestra web emplea cookies de sesión propias que son seguras al utilizar protocolo HTTPS y guarda los datos en un formato cifrado para que no sean vulnerables a ataques.
puedes eliminar las cookies en cualquier momento desde tu ordenador, pero te menciono algunos inconvenientes que puedes tener después de borrar esta información:
Se borran algunos ajustes de configuración de los sitios. Por ejemplo, si habías accedido, deberás volver a acceder.
Algunos sitios pueden parecer más lentos porque se debe volver a cargar parte del contenido, como las imágenes.
                            </li>
                            <li>
                                <span>
                                    Cesión o transmisión de datos
                                </span>
                                Aquarius IT, S.A. de C.V., no venderá, cederá ni distribuirá tu información personal, sin tu consentimiento, salvo que sea requerido por un juez con un orden judicial.
                            </li>
                            <li>
                                <span>
                                    Forma de contacto
                                </span>
                                4ª. C. Oriente, No.2, Chalatenango, Chalatenango, El Salvador, C.A.
contacto@aquariusit-sv.com

                            </li>
                            <li>
                                <span>
                                    Control de su información personal
                                </span>
                                podrás solicitarnos en cualquier momento la información que tenemos de ti en nuestra base de datos
En cualquier momento puedes restringir la recopilación o el uso de tu información personal, proporcionada a nuestra web al correo que aparece en la sección Forma de contacto.
                            </li>
                            <li>
                                <span>
                                    Sobre el cambio de política de privacidad
                                </span>
                                Aquarius IT, S.A. de C.V., se reserva el derecho de cambiar los términos de la presente Política de Privacidad en cualquier momento, por lo que te pedimos que la revises cada cierto tiempo.

                                Chalatenango, 22 de abril de 2022.
                            </li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection