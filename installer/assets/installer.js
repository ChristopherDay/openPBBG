(function(){
	'use strict';
	const steps = Array.from(document.querySelectorAll('.step-body'));
	const stepNodes = Array.from(document.querySelectorAll('.stepper .step'));
	const progressBar = document.getElementById('installerProgress');
	let current = 0;

	function showStep(i){
		steps.forEach(s => s.classList.add('d-none'));
		const node = steps[i];
		if(node) node.classList.remove('d-none');
		stepNodes.forEach((sn, idx) => sn.classList.toggle('active', idx === i));
		const pct = Math.round((i)/(steps.length-1)*100);
		progressBar.style.width = pct + '%';
		current = i;
	}

	// Prev / Next handlers
	document.body.addEventListener('click', function(e){
		if(e.target.closest('.btn-next')){
			if(!validateStep(current)) return;
			if(current < steps.length-1) showStep(current+1);
		}
		if(e.target.closest('.btn-prev')){
			if(current > 0) showStep(current-1);
		}
	});

	// allow clicking stepper steps for quick navigation
	document.querySelectorAll('.stepper .step').forEach(s => {
		s.addEventListener('click', () => {
			const i = parseInt(s.dataset.step,10);
			// only allow forward if previous valid
			if(i <= current || validateStepRange(i)) showStep(i);
		});
	});

	function validateStepRange(target){
		// ensure all intermediate steps are valid (simple checks)
		for(let i=0;i<target;i++){
			if(!validateStep(i,true)) return false;
		}
		return true;
	}

	function validateStep(i,quiet){
		const section = steps[i];
		if(!section) return true;
		// simple required field check
		const required = Array.from(section.querySelectorAll('[required]'));
		for(const el of required){
			if(!el.value.trim()){
				if(!quiet) el.classList.add('is-invalid');
				return false;
			} else {
				el.classList.remove('is-invalid');
			}
		}
		// password confirm check on admin step
		if(section.dataset.step == '3'){
			const pass = section.querySelector('[name=admin_pass]');
			const confirm = section.querySelector('[name=admin_pass_confirm]');
			if(pass && confirm && pass.value !== confirm.value){
				if(!quiet){
					confirm.classList.add('is-invalid');
					alert('Passwords do not match.');
				}
				return false;
			}
		}
		return true;
	}

	// Populate summary on entering last step
	document.addEventListener('click', function(e){
		if(e.target.closest('.btn-next')){
			if(current+1 === steps.length-1){ // about to enter final step
				const form = document.getElementById('installerForm');
				const fd = new FormData(form);
				document.getElementById('s_db').textContent = `${fd.get('db_user') || '—'} @ ${fd.get('db_host') || '—'} / ${fd.get('db_name') || '—'}`;
				document.getElementById('s_admin').textContent = `${fd.get('admin_user') || '—'} (${fd.get('admin_email') || '—'})`;
			}
		}
	});

	// Install simulation
	document.getElementById('startInstall').addEventListener('click', function(){
		if(!validateStepRange(steps.length-1)) return;
		const wrap = document.getElementById('installProgressWrap');
		const bar = document.getElementById('installProgress');
		const status = document.getElementById('installStatus');
		this.disabled = true;
		wrap.classList.remove('d-none');
		let val = 0;
		status.textContent = 'Installing...';
		const t = setInterval(()=>{
			val += Math.floor(Math.random()*15)+5;
			if(val>100) val=100;
			bar.style.width = val + '%';
			if(val >= 100){
				clearInterval(t);
				status.textContent = 'Finalizing...';
				setTimeout(()=> {
					// show done box
					document.querySelector('form#installerForm').classList.add('d-none');
					document.getElementById('doneBox').classList.remove('d-none');
					window.scrollTo({top:0,behavior:'smooth'});
				},700);
			}
		},400);
	});

	// Show requirement badges interactive (optional)
	(function renderReqs(){
		const reqs = window.__INSTALLER_REQS || [];
		// nothing to do; server already rendered them. Could add JS checks here.
	})();

	// initialize
	showStep(0);
})();
