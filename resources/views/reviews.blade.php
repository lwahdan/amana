<div class=" mx-auto p-6">
    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            <h3 class="text-2xl font-bold mb-6">Customer Reviews</h3>

            @forelse ($reviews as $review)
                <div class="mb-6 border-b pb-6 last:border-b-0 last:pb-0">
                    <div class="flex items-center mb-3">
                        <div
                            class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-semibold">
                            {{ strtoupper(substr($review->user->name, 0, 1)) }}
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-800">{{ $review->user->name }}</h4>
                            <div class="flex items-center mt-1">
                                <div class="flex text-yellow-400">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review->rating)
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span class="ml-2 text-sm text-gray-600">
                                    {{ $review->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ml-14">
                        <p class="text-gray-700">{{ $review->review }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <i class="fas fa-comment-slash text-4xl text-gray-400 mb-3"></i>
                    <p class="text-gray-500">No reviews available for this provider yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<div class="w-full bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h4 class="text-2xl font-bold mb-6">Share Your Experience</h4>

            <form action="{{ route('user.reviews.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="provider_id" value="{{ $provider->id }}">

                <div>
                    <label for="service_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Service
                    </label>
                    <select name="service_id" id="service_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                        @foreach ($provider->services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Rating
                    </label>
                    <div class="flex items-center space-x-1">
                        <input type="hidden" name="rating" id="rating-input" value="0" required>
                        <div class="star-rating flex">
                            @for ($i = 1; $i <= 5; $i++)
                                <button type="button" data-rating="{{ $i }}"
                                    class="star-btn text-2xl text-gray-300 hover:text-yellow-400 transition-colors duration-150">
                                    <i class="far fa-star"></i>
                                </button>
                            @endfor
                        </div>
                    </div>
                </div>

                <div>
                    <label for="review" class="block text-sm font-medium text-gray-700 mb-2">
                        Review
                    </label>
                    <textarea name="review" id="review" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required></textarea>
                </div>

                <div>
                    <button type="submit"
                        class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Submit Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const starBtns = document.querySelectorAll('.star-btn');
        const ratingInput = document.getElementById('rating-input');

        starBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const rating = parseInt(this.dataset.rating);
                ratingInput.value = rating;

                // Update all stars
                starBtns.forEach((star, index) => {
                    const starIcon = star.querySelector('i');
                    if (index < rating) {
                        starIcon.classList.remove('far');
                        starIcon.classList.add('fas');
                        star.classList.add('text-yellow-400');
                        star.classList.remove('text-gray-300');
                    } else {
                        starIcon.classList.remove('fas');
                        starIcon.classList.add('far');
                        star.classList.remove('text-yellow-400');
                        star.classList.add('text-gray-300');
                    }
                });
            });

            // Hover effects
            btn.addEventListener('mouseenter', function() {
                const rating = parseInt(this.dataset.rating);
                starBtns.forEach((star, index) => {
                    if (index < rating) {
                        star.classList.add('text-yellow-400');
                        star.classList.remove('text-gray-300');
                    }
                });
            });

            btn.addEventListener('mouseleave', function() {
                const currentRating = parseInt(ratingInput.value);
                starBtns.forEach((star, index) => {
                    const starIcon = star.querySelector('i');
                    if (index < currentRating) {
                        starIcon.classList.remove('far');
                        starIcon.classList.add('fas');
                        star.classList.add('text-yellow-400');
                        star.classList.remove('text-gray-300');
                    } else {
                        starIcon.classList.remove('fas');
                        starIcon.classList.add('far');
                        star.classList.remove('text-yellow-400');
                        star.classList.add('text-gray-300');
                    }
                });
            });
        });
    });
</script>
