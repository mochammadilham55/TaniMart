<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        $product = $this->route('product');
        abort_if($product && $product->user_id !== $this->user()->id, 404);

        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['nullable', 'string', 'max:2000'],
            'price' => ['required', 'numeric', 'min:100', 'max:99999999'],
            'stock' => ['required', 'integer', 'min:0', 'max:1000000'],
            'unit' => ['required', 'string', 'max:20'],
            'weight' => ['required', 'integer', 'min:0', 'max:1000000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama produk wajib diisi.',
            'category_id.required' => 'Pilih kategori produk.',
            'price.required' => 'Harga wajib diisi.',
            'price.min' => 'Harga minimal Rp 100.',
            'stock.required' => 'Stok wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.max' => 'Ukuran foto maksimal 2 MB.',
        ];
    }
}
