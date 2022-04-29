<div>
    <p>Weather in Skopje is {{ $data->data[0]->weather->description }}</p>

    <img src="https://www.weatherbit.io/static/img/icons/{{ $data->data[0]->weather->icon }}.png" alt="icon">
</div>