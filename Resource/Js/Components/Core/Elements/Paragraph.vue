<template>
    <p :class="classes">
        {{ paragraph }}
    </p>
</template>

<script>
export default {
    props: ['paragraph', 'classes'],
}
</script>