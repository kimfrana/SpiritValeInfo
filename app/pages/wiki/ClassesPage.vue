<template>
    <Head title="Classes - SpiritVale Info"></Head>
    <WikiLayout>
        <div class="wiki-content">
            <h1 class="page-title">Classes</h1>

            <p>
                Classes define a character’s role in combat and progression. They determine which skills can
                be learned, what weapons are most effective, and how a character interacts with the world.
            </p>

            <p>
                Each character has two levels:
            </p>
            <ul>
                <li><strong>Base Level</strong> — determines attribute points.</li>
                <li><strong>Job Level</strong> — determines skill points and class growth.</li>
            </ul>

            <h2>Job Levels</h2>
            <p>
                In addition to Base Level, which provides attribute points, every character also
                has a <strong>Job Level</strong>.
            </p>
            <ul>
                <li>All classes begin at <strong>Job Level 1</strong> as their base class.</li>
                <li>
                    When enough experience is gained, the character earns a Job Level and receives
                    a single skill point.
                </li>
                <li>
                    Skill points are spent in the <strong>Skills</strong> tab to unlock or improve abilities.
                </li>
                <li>
                    Each class has more skills than available job points, so it is not possible to unlock
                    every skill.
                </li>
            </ul>
            <p>
                There are currently two different job progression paths depending on the class chosen:
            </p>
            <ul>
                <li>
                    Classes without access to an advanced job can gain a total of <strong>70 Job Levels</strong>,
                    providing 70 skill points in total (including the point from Level 1).
                </li>
                <li>
                    Classes with access to an advanced job instead gain <strong>50 Job Levels</strong> as their
                    base form. At <strong>Job Level 50</strong> they may advance to their improved class, unlocking
                    a further <strong>70 Job Levels</strong>. These points can be spent freely on skills from either
                    the base or advanced job.
                </li>
            </ul>

            <h2>Base Classes</h2>
            <p>
                The seven base classes are chosen at character creation. Each class provides a distinct playstyle,
                weapon preference, and combat role.
            </p>

            <h3>Warrior</h3>
            <ul>
                <li>A raw melee combatant focused on overwhelming damage and brutal offense.</li>
                <li><strong>Weapon:</strong> Axe</li>
                <li><strong>Role:</strong> Melee, Crit</li>
                <li><strong>Main Stat:</strong> Strength (STR)</li>
            </ul>
            <p><strong>See Also:</strong> <Link href="/wiki/Warrior">Warrior</Link></p>

            <h3>Knight</h3>
            <ul>
                <li>A balanced melee fighter trained in spear and shield combat.</li>
                <li><strong>Weapon:</strong> Spear (with Shield)</li>
                <li><strong>Role:</strong> Melee, Tank</li>
                <li><strong>Main Stat:</strong> Vitality (VIT)</li>
            </ul>
            <p><strong>See Also:</strong> <Link href="/wiki/Knight">Knight</Link></p>

            <h3>Rogue</h3>
            <ul>
                <li>A nimble melee fighter blending agility, poison, and precision.</li>
                <li><strong>Weapon:</strong> Dagger</li>
                <li><strong>Role:</strong> Melee, Poison</li>
                <li><strong>Main Stat:</strong> Agility (AGI)</li>
            </ul>
            <p><strong>See Also:</strong> <Link href="/wiki/Rogue">Rogue</Link></p>

            <h3>Scout</h3>
            <ul>
                <li>A mobile ranged fighter specializing in precision and kiting.</li>
                <li><strong>Weapon:</strong> Bow</li>
                <li><strong>Role:</strong> Ranged Physical Damage</li>
                <li><strong>Main Stat:</strong> Dexterity (DEX)</li>
            </ul>
            <p><strong>See Also:</strong> <Link href="/wiki/Scout">Scout</Link></p>

            <h3>Mage</h3>
            <ul>
                <li>A student of elemental magic, casting destructive spells from range.</li>
                <li><strong>Weapon:</strong> Staff</li>
                <li><strong>Role:</strong> Elemental Magic</li>
                <li><strong>Main Stat:</strong> Intelligence (INT)</li>
            </ul>
            <p><strong>See Also:</strong> <Link href="/wiki/Mage">Mage</Link></p>

            <h3>Acolyte</h3>
            <ul>
                <li>A faithful healer who channels holy light to protect allies.</li>
                <li><strong>Weapon:</strong> Book</li>
                <li><strong>Role:</strong> Healing, Support, Holy Magic</li>
                <li><strong>Main Stat:</strong> Intelligence (INT)</li>
            </ul>
            <p><strong>See Also:</strong> <Link href="/wiki/Acolyte">Acolyte</Link></p>

            <h3>Summoner</h3>
            <ul>
                <li>A mystical conjurer who fights alongside summoned companions.</li>
                <li><strong>Weapon:</strong> Mace</li>
                <li><strong>Role:</strong> Summoning, Dark Magic</li>
                <li><strong>Main Stat:</strong> Intelligence (INT)</li>
            </ul>
            <p><strong>See Also:</strong> <Link href="/wiki/Summoner">Summoner</Link></p>


            <h2>Advanced Classes</h2>
            <p>
                Advanced classes cannot be chosen at the start of the game. Instead, they become available as
                progression paths at Job Level 50 by speaking to a class representative.
            </p>

            <h3>Wizard</h3>
            <ul>
                <li>The advanced form of the Mage, channeling destructive elemental magic at its most powerful.</li>
                <li><strong>Weapon:</strong> Staff</li>
                <li><strong>Role:</strong> Elemental Magic</li>
                <li><strong>Main Stat:</strong> Intelligence (INT)</li>
            </ul>
            <p><strong>See Also:</strong> <Link href="/wiki/Wizard">Wizard</Link></p>

            <h3>Shinobi</h3>
            <ul>
                <li>The advanced form of the Rogue, mastering shadow techniques and clone combat.</li>
                <li>Excels at autocast abilities and deceptive clone-based strategies.</li>
                <li><strong>Weapon:</strong> Dagger</li>
                <li><strong>Role:</strong> Autocast, Clones</li>
                <li><strong>Main Stat:</strong> Agility (AGI)</li>
            </ul>
            <p><strong>See Also:</strong> <Link href="/wiki/Shinobi">Shinobi</Link></p>

            <h3>Priest</h3>
            <ul>
                <li>The advanced form of the Acolyte, channeling divine light to heal allies and smite undead foes.</li>
                <li>Excels in both powerful single-target and area healing, while wielding Holy elemental magic.</li>
                <li><strong>Weapon:</strong> Mace</li>
                <li><strong>Role:</strong> Healer, Support</li>
                <li><strong>Main Stat:</strong> Intelligence (INT), Vitality (VIT)</li>
            </ul>
            <p><strong>See Also:</strong> <Link href="/wiki/Priest">Priest</Link></p>

            <h3>Paladin</h3>
            <ul>
                <li>
                    The advanced form of the Knight, a holy frontline warrior who guards allies with shield and
                    steel while smiting foes with sacred power.
                </li>
                <li>
                    A hybrid class whose holy abilities scale with VIT and INT, while physical skills draw on STR.
                </li>
                <li><strong>Weapon:</strong> Sword, Mace, Shield</li>
                <li><strong>Role:</strong> Tank, Support, Melee Holy</li>
                <li><strong>Main Stat:</strong> Vitality (VIT), Intelligence (INT), Strength (STR)</li>
            </ul>
            <p><strong>See Also:</strong> <Link href="/wiki/Paladin">Paladin</Link></p>

            <h2>Base Class Summary</h2>
            <table>
                <thead>
                <tr>
                    <th colspan="3">Base Class Comparison</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><Link href="/wiki/Warrior">Warrior</Link></td>
                    <td>Axe</td>
                    <td>Melee, Crit</td>
                    <td>STR</td>
                </tr>
                <tr>
                    <td><Link href="/wiki/Knight">Knight</Link></td>
                    <td>Spear (Shield)</td>
                    <td>Melee, Tank</td>
                    <td>VIT</td>
                </tr>
                <tr>
                    <td><Link href="/wiki/Rogue">Rogue</Link></td>
                    <td>Dagger</td>
                    <td>Melee, Poison</td>
                    <td>AGI</td>
                </tr>
                <tr>
                    <td><Link href="/wiki/Scout">Scout</Link></td>
                    <td>Bow</td>
                    <td>Ranged Physical Damage</td>
                    <td>DEX</td>
                </tr>
                <tr>
                    <td><Link href="/wiki/Mage">Mage</Link></td>
                    <td>Staff</td>
                    <td>Elemental Magic</td>
                    <td>INT</td>
                </tr>
                <tr>
                    <td><Link href="/wiki/Acolyte">Acolyte</Link></td>
                    <td>Book</td>
                    <td>Healing, Support, Holy Magic</td>
                    <td>INT</td>
                </tr>
                <tr>
                    <td><Link href="/wiki/Summoner">Summoner</Link></td>
                    <td>Mace</td>
                    <td>Summoning, Dark Magic</td>
                    <td>INT</td>
                </tr>
                </tbody>
            </table>
        </div>
    </WikiLayout>
</template>

<script setup lang="ts">

import { Head, Link } from '@inertiajs/vue3';
import WikiLayout from '@/Layouts/WikiLayout.vue';
</script>

<style scoped>

</style>