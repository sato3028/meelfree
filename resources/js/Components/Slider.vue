<template>
  <div class="slider-001">
    <div
      v-for="(slide, index) in slides"
      :key="index"
      class="slide-001"
      :style="{ left: `-${currentSlide * 100}%` }"
    >
      <div class="numbertext">{{ index + 1 }}/{{ slides.length }}</div>
      <div class="slide-content-001">
        <img :src="slide.url" alt="slide image" />
      </div>
      <div class="slide-caption-001">{{ slide.caption }}</div>
    </div>

    <span class="prev-001" @click="prevSlide">&#10094;</span>
    <span class="next-001" @click="nextSlide">&#10095;</span>

    <div class="dots">
      <span
        v-for="(slide, index) in slides"
        :key="index"
        class="dot"
        @click="setSlide(index)"
      ></span>
    </div>
  </div>
</template>

<script setup>
import { ref, toRefs, defineProps } from 'vue';

const props = defineProps({
  images: Array
});

const defaultImage = {
  url: "https://res.cloudinary.com/dqaxgeag8/image/upload/v1697804642/20200501_noimage_k5bak3.jpg",
  caption: "no image"
};

const slides = ref(props.images.length > 0 ? props.images.map((image, index) => ({
  url: image.image_url,
  caption: "画像-" + (index + 1)
})) : [defaultImage]);

const currentSlide = ref(0);

const setSlide = index => {
  currentSlide.value = index;
};

const nextSlide = () => {
  currentSlide.value = (currentSlide.value + 1) % slides.value.length;
};

const prevSlide = () => {
  currentSlide.value = currentSlide.value === 0 ? slides.value.length - 1 : currentSlide.value - 1;
};
</script>

<style scoped>
.slider-001 {
  width: 100%;
  position: relative;
  margin: 0 auto;
  overflow: hidden;
  display: flex;
  border-radius: 6px;
}

.slide-001 {
  width: 100%;
  flex-shrink: 0;
  position: relative;
  top: 0;
  left: 0;
  transition: all 0.6s ease-in-out;
}

.slide-content-001 {
  width: 100%;
  height: 400px;
  background-color: #c8e4ff;
}

.slide-content-001 img {
  width:100%;
  object-fit: cover;
  height: 100%;
}

.prev-001,
.next-001 {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  height: 65px;
  padding: 16px;
  margin-top: -28px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: all 0.2s ease;
  border-radius: 0 4px 4px 0;
  user-select: none;
}

.next-001 {
  right: 0;
  border-radius: 4px 0 0 4px;
}

.prev-001:hover,
.next-001:hover {
  background-color: rgba(107, 182, 255, 0.8);
}

.slide-caption-001 {
  color: white;
  font-size: 15px;
  padding: 0;
  position: absolute;
  bottom: 31px;
  width: 100%;
  text-align: center;
}

.numbertext {
  color: white;
  font-size: 12px;
  font-weight: bold;
  padding: 8px 16px;
  position: absolute;
  top: 0;
}

.dots {
  height: 15px;
  padding: 0;
  position: absolute;
  bottom: 22px;
  width: 100%;
  text-align: center;
}

.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 10px 4px;
  background-color: white;
  border-radius: 50%;
  display: inline-block;
  transition: all 0.2s ease;
}

.dot:hover {
  background-color: rgba(107, 182, 255, 0.8);
}
</style>
