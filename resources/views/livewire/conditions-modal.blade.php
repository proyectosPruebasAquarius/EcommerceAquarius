<div>
    <div class="modal fade" id="conditionsModal" tabindex="-1" aria-labelledby="conditionsModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="conditionsModalLabel">{{ $condition === 'terminos' ? 'Términos y Condiciones' : 'Política de Privacidad' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($condition === 'terminos')
                    <p>
                        

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sit amet finibus nisi, et fringilla mauris. Vivamus feugiat risus ligula, et consectetur leo facilisis ut. Aenean mattis erat tellus, quis elementum massa congue et. Maecenas molestie est nec augue fringilla feugiat. Quisque quis aliquam leo, sed pellentesque enim. Aenean commodo tempus libero, et suscipit eros. Nulla pulvinar erat quis nibh tristique suscipit. Fusce porttitor convallis ligula eu efficitur. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla facilisi.

Duis sed lorem hendrerit, mollis diam ut, ultricies risus. Aliquam sit amet ipsum porttitor, auctor ex sed, ultricies metus. Sed laoreet rhoncus sapien. Morbi nec eros lobortis, viverra dui ac, facilisis dui. Morbi lacus libero, ullamcorper quis ultrices vitae, suscipit eu massa. Mauris ac mauris ante. Aliquam vulputate lorem eu urna interdum, eget convallis libero sollicitudin. Nulla dictum sollicitudin elementum. Sed luctus commodo justo, venenatis aliquet dolor. Morbi ullamcorper, diam sed rutrum faucibus, odio ligula feugiat augue, at egestas ipsum nulla quis arcu. Vestibulum ultrices neque ac sem posuere feugiat.

Aenean quis ante consectetur purus consectetur auctor. Aenean quis sem iaculis, faucibus sem quis, lacinia nunc. Donec orci orci, porttitor viverra urna non, eleifend volutpat quam. Duis in sodales mi, id tempor turpis. Quisque id ullamcorper augue. Nunc purus nisi, luctus at ipsum ut, laoreet accumsan dolor. Aliquam eget lobortis eros, in mollis leo. Donec malesuada vel mi in tempor.

Maecenas non bibendum sapien, eget venenatis magna. Morbi ornare sodales gravida. Nulla ornare, elit nec faucibus viverra, ex quam dictum orci, eget tincidunt dui purus nec sem. Pellentesque hendrerit dui massa, nec dictum velit dictum iaculis. Cras aliquam maximus erat, eget euismod erat lacinia quis. Morbi mollis eros non libero rutrum faucibus. Morbi mollis ipsum in justo ullamcorper aliquam nec vel dui. Mauris ultrices gravida nisl sed ultrices. Fusce rutrum neque eget nulla luctus, quis luctus mi iaculis. Nullam sed consectetur quam. Aenean nec libero dolor.

Fusce accumsan odio sem, ac faucibus massa facilisis semper. Cras condimentum consectetur velit, ac gravida nibh facilisis a. Aliquam erat volutpat. Cras libero justo, pretium eu mi in, aliquam feugiat urna. Nullam vitae suscipit nunc, ut consectetur tortor. Nulla aliquam eros sed odio cursus pharetra. Proin convallis, quam nec hendrerit viverra, nisi lectus porttitor mauris, sed sagittis libero lectus eget neque. Mauris tristique mollis neque in pulvinar. Nulla ac ligula posuere, blandit ex id, lobortis quam. Aenean dui libero, egestas sit amet feugiat ac, posuere at sapien. 
                    </p>
                @else
                    <p>
                        

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sit amet finibus nisi, et fringilla mauris. Vivamus feugiat risus ligula, et consectetur leo facilisis ut. Aenean mattis erat tellus, quis elementum massa congue et. Maecenas molestie est nec augue fringilla feugiat. Quisque quis aliquam leo, sed pellentesque enim. Aenean commodo tempus libero, et suscipit eros. Nulla pulvinar erat quis nibh tristique suscipit. Fusce porttitor convallis ligula eu efficitur. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla facilisi.

Duis sed lorem hendrerit, mollis diam ut, ultricies risus. Aliquam sit amet ipsum porttitor, auctor ex sed, ultricies metus. Sed laoreet rhoncus sapien. Morbi nec eros lobortis, viverra dui ac, facilisis dui. Morbi lacus libero, ullamcorper quis ultrices vitae, suscipit eu massa. Mauris ac mauris ante. Aliquam vulputate lorem eu urna interdum, eget convallis libero sollicitudin. Nulla dictum sollicitudin elementum. Sed luctus commodo justo, venenatis aliquet dolor. Morbi ullamcorper, diam sed rutrum faucibus, odio ligula feugiat augue, at egestas ipsum nulla quis arcu. Vestibulum ultrices neque ac sem posuere feugiat.

Aenean quis ante consectetur purus consectetur auctor. Aenean quis sem iaculis, faucibus sem quis, lacinia nunc. Donec orci orci, porttitor viverra urna non, eleifend volutpat quam. Duis in sodales mi, id tempor turpis. Quisque id ullamcorper augue. Nunc purus nisi, luctus at ipsum ut, laoreet accumsan dolor. Aliquam eget lobortis eros, in mollis leo. Donec malesuada vel mi in tempor.

Maecenas non bibendum sapien, eget venenatis magna. Morbi ornare sodales gravida. Nulla ornare, elit nec faucibus viverra, ex quam dictum orci, eget tincidunt dui purus nec sem. Pellentesque hendrerit dui massa, nec dictum velit dictum iaculis. Cras aliquam maximus erat, eget euismod erat lacinia quis. Morbi mollis eros non libero rutrum faucibus. Morbi mollis ipsum in justo ullamcorper aliquam nec vel dui. Mauris ultrices gravida nisl sed ultrices. Fusce rutrum neque eget nulla luctus, quis luctus mi iaculis. Nullam sed consectetur quam. Aenean nec libero dolor.

Fusce accumsan odio sem, ac faucibus massa facilisis semper. Cras condimentum consectetur velit, ac gravida nibh facilisis a. Aliquam erat volutpat. Cras libero justo, pretium eu mi in, aliquam feugiat urna. Nullam vitae suscipit nunc, ut consectetur tortor. Nulla aliquam eros sed odio cursus pharetra. Proin convallis, quam nec hendrerit viverra, nisi lectus porttitor mauris, sed sagittis libero lectus eget neque. Mauris tristique mollis neque in pulvinar. Nulla ac ligula posuere, blandit ex id, lobortis quam. Aenean dui libero, egestas sit amet feugiat ac, posuere at sapien. 
                    </p>
                @endif
            </div>
            <div class="modal-footer border-0">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn" style="background: #fcde67; color: #000"  data-bs-dismiss="modal">Listo</button>
            </div>
        </div>
        </div>
    </div>
</div>
