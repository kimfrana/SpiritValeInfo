<template>
    <div class="wiki-content">
        <h2>See Also</h2>
        <div style="max-width: 700px; border: 1px solid #555; padding: 1rem; border-radius: 1rem;">
            <div style="font-size: 1.1rem; font-weight: bold; text-align: center;">Navigation</div>
            <table class="wiki-navigation-table">
                <tbody>
                <tr>
                    <th colspan="2">Classes</th>
                </tr>
                <tr>
                    <td>Base</td>
                    <td>
                        <Link href="/wiki/Knight">Knight</Link> •
                        <Link href="/wiki/Warrior">Warrior</Link> •
                        <Link href="/wiki/Mage">Mage</Link> •
                        <Link href="/wiki/Summoner">Summoner</Link> •
                        <Link href="/wiki/Rogue">Rogue</Link> •
                        <Link href="/wiki/Acolyte">Acolyte</Link> •
                        <Link href="/wiki/Scout">Scout</Link>
                    </td>
                </tr>
                <tr>
                    <td>Advanced</td>
                    <td>
                        <Link href="/wiki/Wizard">Wizard</Link> •
                        <Link href="/wiki/Shinobi">Shinobi</Link> •
                        <Link href="/wiki/Priest">Priest</Link> •
                        <Link href="/wiki/Paladin">Paladin</Link> •
                        <Link href="/wiki/Gunslinger">Gunslinger</Link> •
                        <Link href="/wiki/Necromancer">Necromancer</Link> •
                        <Link href="/wiki/Berserker">Berserker</Link>
                    </td>
                </tr>
                <tr>
                    <td>Special</td>
                    <td>
                        <Link href="/wiki/Weaver">Weaver</Link>
                    </td>
                </tr>
                </tbody>
            </table>

            <table class="wiki-navigation-table">
                <tbody>
                <tr>
                    <th colspan="2">Game Systems</th>
                </tr>
                <tr>
                    <td><Link href="/wiki/Character">Character</Link></td>
                    <td>
                        <Link href="/wiki/Classes">Classes</Link> •
                        <Link href="/wiki/Attributes">Attributes</Link> •
                        <Link href="/wiki/Skills">Skills</Link> •
                        <Link href="/wiki/Item_Storage">Storage</Link> •
                        <Link href="/wiki/Coin">Coin</Link>
                    </td>
                </tr>
                <tr>
                    <td><Link href="/wiki/Items">Items</Link></td>
                    <td>
                        <Link href="/wiki/Consumables">Consumables</Link> •
                        <Link href="/wiki/Equipment">Equipment</Link> •
                        <Link href="/wiki/Card_System">Cards</Link> •
                        <Link href="/wiki/Artifacts">Artifacts</Link> •
                        <Link href="/wiki/Materials">Materials</Link>
                    </td>
                </tr>
                <tr>
                    <td><Link href="/wiki/Combat">Combat</Link></td>
                    <td>
                        <Link href="/wiki/Dodge_Roll">Dodge Roll</Link> •
                        <Link href="/wiki/Elements">Elements</Link> •
                        <Link href="/wiki/Monsters">Monsters</Link> •
                        <Link href="/wiki/Arena">Arena</Link>
                    </td>
                </tr>
                <tr>
                    <td><Link href="/wiki/World">World</Link></td>
                    <td>
                        <Link href="/wiki/Waypoints">Waypoints</Link> •
                        <Link href="/wiki/Non-Player_Character">Non-Player Characters</Link> •
                        <Link href="/wiki/Refinement_System">Refinement</Link> •
                        <Link href="/wiki/Crafting_System">Crafting</Link>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>

<style scoped>
.wiki-navigation-table {
    border: 1px solid #555;
    margin: 1rem 0;
    width: 100%;
}
.wiki-navigation-table td, .wiki-navigation-table th {
    padding: 0.5rem;
}
</style>
