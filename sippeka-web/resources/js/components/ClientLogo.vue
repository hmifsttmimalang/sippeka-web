<template>
    <div class="col-xl-2 col-md-3 col-6 client-logo">
      <img :src="assetPath" class="img-fluid" alt="" />
    </div>
</template>
  
<script setup>
  defineProps({
    src: {
      type: String,
      required: true,
    },
  })
  
  const assetPath = computed(() => {
    return `/assets/user/img/silastri/${src}`
  })
</script>
  