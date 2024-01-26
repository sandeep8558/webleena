<template>
    <h1 :class="headerclasses">
        {{ headertext }}
    </h1>
</template>

<script>
export default {
    props: ['headertext', 'headerclasses'],
}
</script>