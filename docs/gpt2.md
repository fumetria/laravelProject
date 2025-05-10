<tbody>
                    <tr v-for="book in books" :key="book.id" class="items-center even:bg-gray-200">
                        <td class="p-2">{{ book.id_isbn }}</td>
                        <td class="p-2">{{ book.isbn }}</td>
                        <td class="p-2 text-wrap">{{ book.title }}</td>
                        <td class="p-2 text-center">{{ book.genre }}</td>
                        <td class="p-2">{{ book.publisher }}</td>
                        <td class="p-2">{{ book.author_id }}</td>
                        <td class="p-2" :class="estado(book.status)">{{
                            book.status
                            }}</td>
                        <td class="p-2 text-center">{{ book.location_floor }}</td>
                        <td class="p-2 text-center">{{ book.location_aisle }}</td>
                        <td class="p-2 text-center">{{ book.location_bookshelves }}</td>
                        <td class="p-2 text-center flex flex-row gap-1 justify-center items-center align-middle">
                            <a :href="route('editBook', book.id_isbn)">
                                <PrimaryButton class=" bg-orange-600  hover:bg-orange-400">
                                    <font-awesome-icon :icon="['fas', 'edit']" class="z-50 text-l  text-stone-50" />
                                </PrimaryButton>
                            </a>
                            <div v-if="$page.props.auth.user.is_admin === 1">
                                <PrimaryButton class="bg-red-600 hover:bg-red-400 focus:bg-red-700 active:bg-red-900" @click.prevent="deleteBook(book.id_isbn)">
                                    <font-awesome-icon :icon="['fas', 'trash-alt']" class="z-50 text-l text-stone-50" />
                                </PrimaryButton>
                            </div>

                        </td>
                    </tr>
                </tbody>
            </table>
como centrar verticalmente y horizontalmente los primaryButton?

ChatGPT Plus
Para centrar vertical y horizontalmente los botones <PrimaryButton> dentro de la celda <td>, puedes ajustar el td y el contenido interno con utilidades de Flexbox de Tailwind CSS.

Actualmente ya tienes clases como flex flex-row gap-1 justify-center items-center align-middle aplicadas en el <td>, pero hay un detalle importante:

align-middle no tiene efecto en elementos flex. Es una clase de table-cell.

La propiedad vertical-align no aplica dentro de un flexbox, por eso necesitas usar items-center correctamente.

Solución:
Asegúrate de que:

El <td> es flex y tiene altura suficiente.

Los botones no tienen márgenes o padding verticales que empujen hacia fuera.

Usas items-center (para eje vertical) y justify-center (para eje horizontal).

Código corregido:
html
Copiar
Editar
<td class="p-2 text-center">
    <div class="flex justify-center items-center gap-1">
        <a :href="route('editBook', book.id_isbn)">
            <PrimaryButton class="bg-orange-600 hover:bg-orange-400">
                <font-awesome-icon :icon="['fas', 'edit']" class="text-l text-stone-50" />
            </PrimaryButton>
        </a>
        <div v-if="$page.props.auth.user.is_admin === 1">
            <PrimaryButton class="bg-red-600 hover:bg-red-400 focus:bg-red-700 active:bg-red-900" @click.prevent="deleteBook(book.id_isbn)">
                <font-awesome-icon :icon="['fas', 'trash-alt']" class="text-l text-stone-50" />
            </PrimaryButton>
        </div>
    </div>
</td>
🔧 Nota: Quité flex del <td> y lo moví a un div interno. Esto es una práctica más robusta para evitar que Tailwind flex colisione con table-based layouts.