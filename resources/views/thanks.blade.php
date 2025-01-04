@extends('layouts.app')
@section('title', 'thanks')
@section('breadcrumb-title', 'Thank You')
@section('breadcrumb-subtitle', 'Thank You')
@section('content')
<div class="py-12 flex items-center justify-center bg-gray-50">
    <div class="max-w-2xl mx-auto text-center">
      <div class="bg-white rounded-xl shadow-sm p-8 animate-fade-in">
        <!-- Success Check Icon -->
        <div class="mb-6">
          <div class="mx-auto w-16 h-16 bg-green-100 rounded-full flex items-center justify-center animate-bounce-in">
            <i class="fas fa-check text-2xl text-green-500"></i>
          </div>
        </div>

        <!-- Thank You Message -->
        <h1 class="text-3xl font-bold text-gray-800 mb-4">
          Thank You!
        </h1>
        
        <p class="text-lg text-gray-600 mb-8">
          We appreciate your time. Our team will get back to you soon.
        </p>

        <!-- Optional Return Home Button -->
        <a href="/" class="inline-flex items-center px-6 py-3 text-base font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200">
          <i class="fas fa-home mr-2"></i>
          Return Home
        </a>
      </div>
    </div>
  </div>

  <style>
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes bounceIn {
      0% { transform: scale(0); }
      50% { transform: scale(1.2); }
      100% { transform: scale(1); }
    }

    .animate-fade-in {
      animation: fadeIn 0.6s ease-out forwards;
    }

    .animate-bounce-in {
      animation: bounceIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
    }
  </style>
@endsection