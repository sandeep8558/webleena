<template>
    <h2 :class="headerclasses">
        {{ headertext }}
    </h2>
</template>

<script>
export default {
    props: ['headertext', 'headerclasses'],
}
</script>