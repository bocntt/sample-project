<div>
  <div>
    @if ($notEnoughImages)
      Not enough images in slider.
      Populate images or remove slider include from pages.index
    @else

      <div id="carousel-example-generic"
            class="carousel slide"
            data-ride="carousel">
        
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic"
              data-slide-to="0"
              class="active">
          </li>

          @foreach (range(1, $count) as $number)
            <li data-target="#carousel-example-generic"
                data-slide-to="{{ $number }}"></li>
          @endforeach

        </ol>

        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img src="{{ $featuredImage->showImage($featuredImage, $imagePath) }}" 
                  alt="{{ $featuredImage->image_name }}">
            <div class="carousel-caption">
              <h1></h1>
            </div>
          </div>

          @foreach ($activeImages as $image)

          <div class="item">
            <img src="{{ $image->showImage($image, $imagePath) }}"
                  alt="{{ $image->image_name }}">
            <div class="carousel-caption">
              <h1></h1>
            </div>
          </div>

          @endforeach

          <!-- Controls -->
          <a href="#carousel-example-generic"
              class="left carousel-control"
              role="button"
              data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"
                  aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a href="#carousel-example-generic"
              class="right carousel-control"
              role="button"
              data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"
                  aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>

        </div>

      </div>
    @endif
  </div>
</div>