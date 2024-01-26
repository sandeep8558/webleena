<template>
    <h5 :class="headerclasses">
        {{ headertext }}
    </h5>
</template>

<script>
export default {
    props: ['headertext', 'headerclasses'],
}
</script>