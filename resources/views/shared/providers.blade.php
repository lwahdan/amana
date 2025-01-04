<div class="expert_doctors_area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="mb-55 section_title">
                    <h3 class="user-secondary text-center">Our Talented Team</h3>
                </div>
            </div>
        </div>
        <div class="row" id="providers-content">
            @foreach ($providers as $provider)
                <div class="single_expert col-xl-3 col-lg-3 col-md-6 mb-30">
                    <div class="expert_thumb">
                        <img src="{{ asset('storage/' . $provider->profile_picture) }}" alt="{{ $provider->name }}" class="provider_image">
                    </div>
                    <div class="experts_name text-center">
                        <h3><a href="{{ route('show.provider.info', $provider->id) }}">{{ $provider->name }}</a></h3>
                        @foreach ($provider->services as $service)
                            <span>{{ $service->name }}</span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="providers_pagination"  id="pagination-links"> {{ $providers->links() }} </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const paginationLinks = document.querySelector('#pagination-links');

        paginationLinks.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior

            if (event.target.tagName === 'A') { // Check if a link was clicked
                const url = event.target.href;

                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');

                        // Update content
                        const newContent = doc.querySelector('#providers-content').innerHTML;
                        document.querySelector('#providers-content').innerHTML = newContent;

                        // Update pagination links
                        const newLinks = doc.querySelector('#pagination-links').innerHTML;
                        document.querySelector('#pagination-links').innerHTML = newLinks;
                    })
                    .catch(error => console.error('Error fetching paginated content:', error));
            }
        });
    });
</script>