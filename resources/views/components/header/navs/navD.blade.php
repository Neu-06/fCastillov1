 <div class="hidden md:flex z-10 md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">

     <nav :class="{ 'flex': open, 'hidden': !open }">
         <x-header.elementosNav.optionNav texto="Gestionar" display="absolute">
             <x-header.elementosNav.optionSecundario link="/gestion/usuarios" texto="Usuarios" />
             <x-header.elementosNav.optionSecundario link="/" texto="Clientes" />
         </x-header.elementosNav.optionNav>

         <x-header.elementosNav.optionNav texto="Categorías" display="absolute">
             <x-header.elementosNav.optionSecundario link="/" texto="Hardware" />
             <x-header.elementosNav.optionSecundario link="/" texto="Software" />
         </x-header.elementosNav.optionNav>

     </nav>


 </div>
