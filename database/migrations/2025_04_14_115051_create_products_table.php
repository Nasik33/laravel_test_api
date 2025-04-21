<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * மைக்ரேஷன் இயக்கப்படும் போது
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // ஐடி
            $table->string('name'); // பெயர்
            $table->mediumText('description'); // விளக்கம்
            $table->string('price'); // விலை
            $table->timestamps(); // நேரம் தொடர்பான புலங்கள் (உருவாக்கப்பட்டது, மாற்றப்பட்டது)
        });
    }

    /**
     * மைக்ரேஷனை மீளதிரும்ப செய்
     */
    public function down(): void
    {
        Schema::dropIfExists('products'); // products அட்டவணையை நீக்கு
    }
};
